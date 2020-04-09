<?php

use Laminas\Code\Scanner\DirectoryScanner;
use Laminas\Di\CodeGenerator\InjectorGenerator;
use Laminas\Di\Config;
use Laminas\Di\Definition\RuntimeDefinition;
use Laminas\Di\Resolver\DependencyResolver;
use Psr\Container\ContainerInterface;

require __DIR__ . '/../vendor/autoload.php';

function deleteDirectory(string $dir): bool
{
    system('rm -rf -- ' . escapeshellarg(realpath($dir)), $retval);
    return $retval == 0;
}
$directories = glob(__DIR__ . '/../src/*/src');
$diCacheDir = __DIR__ . '/../data/cache/di-cache';
deleteDirectory($diCacheDir);
/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';
$config = new Config();
$resolver = new DependencyResolver(new RuntimeDefinition(), $config);
$generator = new InjectorGenerator($config, $resolver);
$resolver->setContainer($container);
$generator->setOutputDirectory($diCacheDir);
$scanner = new DirectoryScanner($directories);
$generator->generate($scanner->getClassNames());
