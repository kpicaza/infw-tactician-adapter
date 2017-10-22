<?php

namespace InFw\TacticianAdapter\Factory;

use InFw\EventSourcing\Emitter;
use Psr\Container\ContainerInterface;

class EmitterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $events = $container->get('config')['events'];

        $emitter = Emitter::instance();

        array_walk($events, function ($listeners, $event) use ($container, $emitter) {
            array_map(function ($listener) use ($container, $emitter, $event) {
                $emitter->addListener($event, $container->get($listener));
            }, $listeners);
        });

        return $emitter;
    }
}
