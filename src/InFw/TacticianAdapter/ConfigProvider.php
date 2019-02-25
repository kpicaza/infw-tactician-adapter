<?php

namespace InFw\TacticianAdapter;

use InFw\TacticianAdapter\Factory\CommandBusFactory;
use InFw\TacticianAdapter\Factory\HandlerLocatorFactory;
use InFw\TacticianAdapter\Factory\LoggerMiddlewareFactory;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use League\Tactician\Logger\Formatter\ClassPropertiesFormatter;
use League\Tactician\Logger\Formatter\Formatter;
use League\Tactician\Logger\LoggerMiddleware;
use League\Tactician\Plugins\LockingMiddleware;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'command-bus' => $this->getBusConfig(),
            'dependencies' => $this->getDependencies(),
        ];
    }

    protected function getBusConfig(): array
    {
        return [
            'locator' => HandlerLocator::class,
            'inflector' => MethodNameInflector::class,
            'extractor' => CommandNameExtractor::class,
            'formatter' => Formatter::class,
            'middleware' => [
                LockingMiddleware::class => LockingMiddleware::class,
                LoggerMiddleware::class => LoggerMiddleware::class,
            ],
            'handler-map' => [],
        ];
    }

    protected function getDependencies(): array
    {
        return [
            'invokables' => [
                Formatter::class => ClassPropertiesFormatter::class,
                MethodNameInflector::class => InvokeInflector::class,
                CommandNameExtractor::class => ClassNameExtractor::class,
                LockingMiddleware::class => LockingMiddleware::class,
            ],
            'factories' => [
                CommandBus::class => CommandBusFactory::class,
                HandlerLocator::class => HandlerLocatorFactory::class,
                LoggerMiddleware::class => LoggerMiddlewareFactory::class,
            ],
        ];
    }
}
