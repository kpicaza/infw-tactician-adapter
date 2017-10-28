<?php

namespace InFw\TacticianAdapter\Factory;

use League\Tactician\Logger\Formatter\Formatter;
use League\Tactician\Logger\LoggerMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new LoggerMiddleware(
            $container->get(Formatter::class),
            $container->get(LoggerInterface::class)
        );
    }
}
