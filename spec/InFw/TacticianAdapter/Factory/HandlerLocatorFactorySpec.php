<?php

namespace spec\InFw\TacticianAdapter\Factory;

use InFw\TacticianAdapter\Factory\HandlerLocatorFactory;
use Interop\Container\ContainerInterface;
use League\Tactician\Container\ContainerLocator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandlerLocatorFactorySpec extends ObjectBehavior
{
    function it_should_create_tactician_container_locator_instance(
        ContainerInterface $container
    ) {
        $container->get('config')->willReturn([
            'command-bus' => [
                'handler-map' => []
            ]
        ])->shouldBeCalled();

        $this->__invoke($container)->shouldBeAnInstanceOf(ContainerLocator::class);
    }
}
