# infw zend-expressive Tactician adapter

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kpicaza/infw-tactician-adapter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/infw-tactician-adapter/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kpicaza/infw-tactician-adapter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/infw-tactician-adapter/build-status/master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c6b276fe-849b-41b7-b78e-4a4342a9b274/mini.png)](https://insight.sensiolabs.com/projects/c6b276fe-849b-41b7-b78e-4a4342a9b274)

[League tactician](http://tactician.thephpleague.com/) command bus adapter for [zend-expressive framework](https://docs.zendframework.com/zend-expressive/).

## Getting started

### Installation

````
composer require infw/tactician-adapter
````

You can activate using Zend config-manager in a expressive modular application.

### Config

Create `command-bus.global.php` file inner config autoload directory.

````
<?php

// command-bus.global.php

<?php

return [
    'dependencies' => [
        'factories' => [
            \Psr\Log\LoggerInterface => new Logger('app') // LoggerInterface is required, add your own logger instance.
        ]
    ],
    'command-bus' => [
        'handler-map' => [
            \App\Command\PingCommand::class => \App\Handler\PingHandler::class
        ],
    ],
];
````

Example command and handler.

````
<?php

namespace App\Command;

class PingCommand
{

}
````

````
<?php

namespace App\Handler;

use App\Command\PingCommand;

class PingHandler
{
    public function __invoke(PingCommand $command)
    {
        return time();
    }
}

````

## Override Command Bus

You can modify the entire command bus to meet the needs of your project.

This is default config.

````
<?php

return [
    'command-bus' => [
        'locator' => \League\Tactician\Handler\Locator\HandlerLocator::class,
        'inflector' => \League\Tactician\Handler\MethodNameInflector\MethodNameInflector::class,
        'extractor' => \League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor::class,
        'formatter' => \League\Tactician\Logger\Formatter\Formatter::class,
        'middleware' => [
            \League\Tactician\Plugins\LockingMiddleware::class,
            \League\Tactician\Logger\LoggerMiddleware::class,
            \League\Tactician\CommandEvents\EventMiddleware::class,

        ],
    ],
];
````

