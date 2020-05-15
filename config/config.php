<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$cacheConfig = ['config_cache_path' => 'data/cache/config-cache.php'];
$providers = [
    // Laminas
    \Laminas\I18n\ConfigProvider::class,
    \Laminas\Di\ConfigProvider::class,
    \Laminas\Form\ConfigProvider::class,
    \Laminas\Hydrator\ConfigProvider::class,
    \Laminas\InputFilter\ConfigProvider::class,
    \Laminas\Filter\ConfigProvider::class,
    \Laminas\HttpHandlerRunner\ConfigProvider::class,
    \Laminas\Router\ConfigProvider::class,
    \Laminas\Validator\ConfigProvider::class,
    // Mezzio
    \Mezzio\ConfigProvider::class,
    \Mezzio\Authentication\ConfigProvider::class,
    \Mezzio\Authentication\Basic\ConfigProvider::class,
    \Mezzio\Authentication\Session\ConfigProvider::class,
    \Mezzio\Authorization\ConfigProvider::class,
    \Mezzio\Csrf\ConfigProvider::class,
    \Mezzio\Flash\ConfigProvider::class,
    \Mezzio\Helper\ConfigProvider::class,
    \Mezzio\LaminasView\ConfigProvider::class,
    \Mezzio\Router\ConfigProvider::class,
    \Mezzio\Router\LaminasRouter\ConfigProvider::class,
    \Mezzio\Session\ConfigProvider::class,
    \Mezzio\Session\Ext\ConfigProvider::class,
    // Woda MezzioModule
    \Woda\MezzioModule\Admin\ConfigProvider::class,
    \Woda\MezzioModule\AssetManager\ConfigProvider::class,
    \Woda\MezzioModule\Authentication\ConfigProvider::class,
    \Woda\MezzioModule\Backend\ConfigProvider::class,
    \Woda\MezzioModule\Config\ConfigProvider::class,
    \Woda\MezzioModule\Core\ConfigProvider::class,
    \Woda\MezzioModule\Doctrine\ConfigProvider::class,
    \Woda\MezzioModule\Error\ConfigProvider::class,
    \Woda\MezzioModule\I18n\ConfigProvider::class,
    \Woda\MezzioModule\LaminasForm\ConfigProvider::class,
    \Woda\MezzioModule\MessageBus\ConfigProvider::class,
    \Woda\MezzioModule\User\ConfigProvider::class,
    // Application
    \App\ConfigProvider::class,
    // Cache
    new ArrayProvider($cacheConfig),
    // Config
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
    // Development
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
];
if (getenv('APP_TESTING') !== false) {
    $providers = array_merge($providers, \Trinet\MezzioTest\TestConfigProvider::load());
}
$aggregator = new ConfigAggregator($providers, $cacheConfig['config_cache_path']);
return $aggregator->getMergedConfig();
