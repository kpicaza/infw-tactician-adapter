<?php

namespace InFw\TacticianAdapter;

use InFw\EventSourcing\Factory\EmitterFactory;
use InFw\TacticianAdapter\Factory\CommandBusFactory;
use InFw\TacticianAdapter\Factory\HandlerLocatorFactory;
use InFw\TacticianAdapter\Factory\LoggerMiddlewareFactory;
use League\Event\EmitterInterface;
use League\Tactician\CommandBus;
use League\Tactician\CommandEvents\EventMiddleware;
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

    protected function getBusConfig()
    {
        return [
            'locator' => HandlerLocator::class,
            'inflector' => MethodNameInflector::class,
            'extractor' => CommandNameExtractor::class,
            'formatter' => Formatter::class,
            'middleware' => [
                LockingMiddleware::class => LockingMiddleware::class,
                LoggerMiddleware::class => LoggerMiddleware::class,
                EventMiddleware::class => EventMiddleware::class,
            ],
            'handler-map' => [],
        ];
    }

    protected function getDependencies()
    {
        return [
            'invokables' => [
                Formatter::class => ClassPropertiesFormatter::class,
                MethodNameInflector::class => InvokeInflector::class,
                CommandNameExtractor::class => ClassNameExtractor::class,
                LockingMiddleware::class => LockingMiddleware::class,
                EventMiddleware::class => EventMiddleware::class,
            ],
            'factories' => [
                EmitterInterface::class => EmitterFactory::class,
                CommandBus::class => CommandBusFactory::class,
                HandlerLocator::class => HandlerLocatorFactory::class,
                LoggerMiddleware::class => LoggerMiddlewareFactory::class,
            ],
            'aliases' => [
                \InFw\EventSourcing\EmitterInterface::class => EmitterInterface::class,
            ],
        ];
    }
}
