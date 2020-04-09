<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Middleware;

use Doctrine\ODM\MongoDB\DocumentManager;
use Interop\Container\ContainerInterface;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\MongoDBHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use ReflectionObject;

use function get_class;

abstract class AbstractMongoDbLoggingMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): LoggingMiddleware
    {
        $logger = new Logger($this->getLoggerName());
        $mongodb = $this->getDocumentManager($container)->getConnection()->getMongoClient()->getClient();
        $odmConfig = $this->getDoctrineConfig($container)['configuration']['odm_default'];
        $handler = new MongoDBHandler($mongodb, $odmConfig['default_db'], $this->getCollection());
        $handler->setFormatter($this->createFormatter());
        $logger->pushHandler($handler);
        return new LoggingMiddleware($logger, LogLevel::INFO);
    }

    abstract protected function getLoggerName(): string;

    private function getDocumentManager(ContainerInterface $container): DocumentManager
    {
        return $container->get(DocumentManager::class);
    }

    /**
     * @return array<string, mixed>
     */
    private function getDoctrineConfig(ContainerInterface $container): array
    {
        return $container->get('Config')['doctrine'];
    }

    abstract protected function getCollection(): string;

    private function createFormatter(): FormatterInterface
    {
        return new class implements FormatterInterface {
            /**
             * @param mixed[] $record
             * @return array<string, mixed>
             */
            public function format(array $record): array
            {
                $command = $record['context']['message'];
                return [
                    '_id' => Uuid::uuid4()->toString(),
                    'class' => get_class($command),
                    'data' => $this->getCommandData($command),
                    'start' => $record['context']['start']->format('Y-m-d\TH:i:s.u'),
                    'end' => $record['context']['end']->format('Y-m-d\TH:i:s.u'),
                ];
            }

            /**
             * @param mixed[] $records
             * @return mixed[]
             */
            public function formatBatch(array $records): array
            {
                return array_map([$this, 'format'], $records);
            }

            /**
             * @return array<string, mixed>
             */
            private function getCommandData(object $command): array
            {
                return $this->getProperties($command);
            }

            /**
             * @param ReflectionClass<object> $class
             * @return array<string, mixed>
             */
            private function getProperties(object $object, ?ReflectionClass $class = null): array
            {
                $reflectionObject = new ReflectionObject($object);
                $parent = $class !== null ? $class->getParentClass() : $reflectionObject->getParentClass();
                $properties = $parent !== false ? $this->getProperties($object, $parent) : [];
                if ($class === null) {
                    $class = $reflectionObject;
                }
                foreach ($class->getProperties() as $property) {
                    $property->setAccessible(true);
                    $properties[$property->getName()] = $property->getValue($object);
                    $property->setAccessible(false);
                }
                return $properties;
            }
        };
    }
}
