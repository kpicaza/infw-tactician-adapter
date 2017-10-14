<?php

namespace InFw\TacticianAdapter\Factory;

use Interop\Container\ContainerInterface;
use League\Tactician\Container\ContainerLocator;

class HandlerLocatorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandsMapping = $container->get('config')['command-bus']['handler-map'];

        return new ContainerLocator($container, $commandsMapping);
    }
}
