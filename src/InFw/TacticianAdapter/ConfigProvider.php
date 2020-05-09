<?php

namespace InFw\TacticianAdapter;

use InFw\TacticianAdapter\Factory\CommandBusFactory;
use InFw\TacticianAdapter\Factory\HandlerLocatorFactory;
use InFw\TacticianAdapter\Factory\QueryBusFactory;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use League\Tactician\Logger\Formatter\ClassPropertiesFormatter;
use League\Tactician\Logger\Formatter\Formatter;
use League\Tactician\Plugins\LockingMiddleware;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'command_bus' => $this->getBusConfig(),
            'query_bus' => $this->getQueryBusConfig(),
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
            ],
            'handler_map' => [],
        ];
    }

    protected function getQueryBusConfig(): array
    {
        return [
            'locator' => 'query_bus.handler_locator',
            'inflector' => MethodNameInflector::class,
            'extractor' => CommandNameExtractor::class,
            'formatter' => Formatter::class,
            'middleware' => [],
            'handler_map' => [],
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
                QueryBus::class => QueryBusFactory::class,
                HandlerLocator::class => [HandlerLocatorFactory::class, 'command_bus'],
                'query_bus.handler_locator' => [HandlerLocatorFactory::class, 'query_bus'],
            ],
        ];
    }
}
