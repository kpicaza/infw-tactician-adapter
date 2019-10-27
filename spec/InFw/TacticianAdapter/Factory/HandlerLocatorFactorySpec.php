<?php

namespace spec\InFw\TacticianAdapter\Factory;

use League\Tactician\Container\ContainerLocator;
use PhpSpec\ObjectBehavior;
use Psr\Container\ContainerInterface;

class HandlerLocatorFactorySpec extends ObjectBehavior
{
    function it_should_create_tactician_container_locator_instance(
        ContainerInterface $container
    ) {
        $container->get('config')->willReturn([
            'command_bus' => [
                'handler_map' => []
            ]
        ])->shouldBeCalled();

        $this->__invoke($container)->shouldBeAnInstanceOf(ContainerLocator::class);
    }
}
