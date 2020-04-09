<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus\Admin\Log;

use Admin\Controller\AbstractAdminController;
use Admin\Controller\Helper\AdminControllerHelper as ControllerHelper;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Eventjet\View\PageHeader;
use MessageBus\Log\MessageLogEntry;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class MessageBusLogHandler implements RequestHandlerInterface
{
    /** @var DocumentManager */
    private $documentManager;

    public function __construct(ControllerHelper $controllerHelper, DocumentManager $documentManager)
    {
        parent::__construct($controllerHelper);
        $this->documentManager = $documentManager;
    }

    public function logAction()
    {
        $this->initLayout();
        return $this->createViewModel(
            'message-bus/admin/log/message-bus-log',
            [
                'messages' => $this->getLog(),
            ]
        );
    }

    private function getLog(): array
    {
        return $this->getLogRepository()->findBy([], ['start' => 'desc'], 200);
    }

    private function getLogRepository(): DocumentRepository
    {
        $objectRepository = $this->documentManager->getRepository(MessageLogEntry::class);
        assert($objectRepository instanceof DocumentRepository);
        return $objectRepository;
    }

    public function entryAction()
    {
        $this->initLayout();
        return $this->createViewModel(
            'message-bus/admin/log/message',
            [
                'message' => $this->getMessage($this->params()->fromRoute('message_id')),
                'pageHeader' => $this->createEntryPageHeader(),
            ]
        );
    }

    private function getMessage(string $id): MessageLogEntry
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getLogRepository()->find($id);
    }

    private function createEntryPageHeader(): PageHeader
    {
        return (new PageHeader('Message Bus Log Entry', $this->getLanguages()))
            ->withBackUrl($this->url()->fromRoute('admin/message-bus-log'));
    }
}
