<?php

declare(strict_types=1);

namespace InFw\TacticianAdapter\Factory;

use InFw\TacticianAdapter\QueryBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use Psr\Container\ContainerInterface;

class QueryBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CommandBus
     */
    public function __invoke(ContainerInterface $container): QueryBus
    {
        $config = $container->get('config')['query_bus'];

        $inflector = $container->get($config['inflector']);
        $locator = $container->get($config['locator']);
        $nameExtractor = $container->get($config['extractor']);

        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            $nameExtractor,
            $locator,
            $inflector
        );

        return new QueryBus(array_merge(
            array_map(function (string $middleware) use ($container) {
                return $container->get($middleware);
            }, $config['middleware']),
            [$commandHandlerMiddleware]
        ));
    }
}
