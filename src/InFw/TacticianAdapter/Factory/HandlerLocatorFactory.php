<?php

namespace InFw\TacticianAdapter\Factory;

use League\Tactician\Container\ContainerLocator;
use Psr\Container\ContainerInterface;

class HandlerLocatorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandsMapping = $container->get('config')['command-bus']['handler-map'];

        return new ContainerLocator($container, $commandsMapping);
    }
}
