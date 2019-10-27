<?php

namespace InFw\TacticianAdapter\Factory;

use League\Tactician\Container\ContainerLocator;
use Psr\Container\ContainerInterface;

class HandlerLocatorFactory
{
    public function __invoke(ContainerInterface $container, string $bus = 'command_bus')
    {
        $commandsMapping = $container->get('config')[$bus]['handler_map'];

        return new ContainerLocator($container, $commandsMapping);
    }
}
