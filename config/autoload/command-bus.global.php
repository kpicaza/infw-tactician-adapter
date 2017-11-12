<?php

return [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
        ]
    ],
    'command-bus' => [
//        'locator' => HandlerLocator::class,
//        'inflector' => MethodNameInflector::class,
//        'extractor' => CommandNameExtractor::class,
//        'formatter' => Formatter::class,
//        'middleware' => [
//            LockingMiddleware::class => LockingMiddleware::class,
//            LoggerMiddleware::class => LoggerMiddleware::class,
//            EventMiddleware::class => EventMiddleware::class,
//        ],
        'handler-map' => [
//            App\Command\PingCommand::class => App\Handler\PingHandler::class
        ],
    ],
];
