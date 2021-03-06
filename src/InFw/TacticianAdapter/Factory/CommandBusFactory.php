<?php

declare(strict_types=1);

namespace InFw\TacticianAdapter\Factory;

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use Psr\Container\ContainerInterface;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container): CommandBus
    {
        $config = $container->get('config')['command_bus'];

        $inflector = $container->get($config['inflector']);
        $locator = $container->get($config['locator']);
        $nameExtractor = $container->get($config['extractor']);

        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            $nameExtractor,
            $locator,
            $inflector
        );

        return new CommandBus(array_merge(
            array_map(function (string $middleware) use ($container) {
                return $container->get($middleware);
            }, $config['middleware']),
            [$commandHandlerMiddleware]
        ));
    }
}
