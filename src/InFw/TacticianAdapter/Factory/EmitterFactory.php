<?php

namespace InFw\TacticianAdapter\Factory;

use InFw\EventSourcing\Emitter;
use Psr\Container\ContainerInterface;

class EmitterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return Emitter::instance();
    }
}
