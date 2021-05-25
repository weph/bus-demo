<?php
declare(strict_types=1);

namespace Tests\Demo;

use Demo\CommandBus;
use Demo\NoHandler;
use PHPUnit\Framework\TestCase;
use Tests\Demo\Dummies\CommandWithoutHandler;
use Tests\Demo\Dummies\DummyCommand;
use Tests\Demo\Dummies\DummyException;
use Tests\Demo\Dummies\DummyHandler;

abstract class CommandBusTest extends TestCase
{
    protected DummyHandler $dummyHandler;

    /**
     * @test
     */
    public function handler_should_be_executed(): void
    {
        $this->commandBus()->handle(DummyCommand::succeed());

        self::assertTrue($this->dummyHandler->invoked, 'Handler was not invoked');
    }

    abstract protected function commandBus(): CommandBus;

    /**
     * @test
     */
    public function exception_thrown_in_handler_should_bubble_up_as_is(): void
    {
        self::expectExceptionObject(new DummyException());

        $this->commandBus()->handle(DummyCommand::fail());
    }

    /**
     * @test
     */
    public function command_without_handler_should_throw_exception(): void
    {
        $command = new CommandWithoutHandler();

        self::expectExceptionObject(NoHandler::forCommand($command));

        $this->commandBus()->handle($command);
    }

    /**
     * @before
     */
    public function setupHandler()
    {
        $this->dummyHandler = new DummyHandler();
    }
}
