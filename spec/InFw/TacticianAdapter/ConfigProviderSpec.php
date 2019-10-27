<?php

namespace spec\InFw\TacticianAdapter;

use InFw\Framework\ConfigProvider;
use League\Tactician\Handler\Locator\HandlerLocator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigProviderSpec extends ObjectBehavior
{
    private $config;

    function let()
    {
        $this->config = $this->__invoke();
    }

    function it_should_load_framework_config()
    {
        $this->config->shouldBeArray();
    }

    function it_should_have_dependencies()
    {
        $dependencies = $this->config['dependencies'];
        $dependencies->shouldBeArray();
        $dependencies['factories']->shouldBeArray();
    }

    function it_should_have_command_bus()
    {
        $commandBus = $this->config['command_bus'];
        $commandBus->shouldBeArray();
        $commandBus['handler_map']->shouldBeArray();
        $commandBus['locator']->shouldBe(HandlerLocator::class);
    }

    function it_should_have_query_bus()
    {
        $commandBus = $this->config['query_bus'];
        $commandBus->shouldBeArray();
        $commandBus['handler_map']->shouldBeArray();
        $commandBus['locator']->shouldBe('query_bus.handler_locator');
    }
}
