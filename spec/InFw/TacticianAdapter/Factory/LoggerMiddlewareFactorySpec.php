<?php

namespace spec\InFw\TacticianAdapter\Factory;

use InFw\TacticianAdapter\Factory\LoggerMiddlewareFactory;
use League\Tactician\Logger\Formatter\ClassPropertiesFormatter;
use League\Tactician\Logger\Formatter\Formatter;
use League\Tactician\Logger\LoggerMiddleware;
use Monolog\Logger;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerMiddlewareFactorySpec extends ObjectBehavior
{
    function it_should_create_tactician_logger_middleware(
        ContainerInterface $container
    )
    {
        $container->get(Formatter::class)->willReturn(
            new ClassPropertiesFormatter()
        )->shouldBeCalled();

        $container->get(LoggerInterface::class)->willReturn(
            new Logger('test')
        )->shouldBeCalled();

        $this->__invoke($container)->shouldBeAnInstanceOf(LoggerMiddleware::class);
    }
}
