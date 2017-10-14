<?php

namespace InFw\TacticianAdapter\Action;

use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use League\Tactician\CommandBus;

abstract class AbstractAction implements ServerMiddlewareInterface
{
    protected $bus;

    public function __construct(CommandBus $commandBus)
    {
        $this->bus = $commandBus;
    }
}
