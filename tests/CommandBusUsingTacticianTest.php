<?php
declare(strict_types=1);

namespace Tests\Demo;

use Demo\CommandBus;
use Demo\CommandBusUsingTactician;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use Tests\Demo\Dummies\DummyCommand;

/**
 * @covers \Demo\CommandBusUsingTactician
 */
final class CommandBusUsingTacticianTest extends CommandBusTest
{
    private CommandBusUsingTactician $subject;

    protected function commandBus(): CommandBus
    {
        return $this->subject;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new CommandBusUsingTactician(
            new \League\Tactician\CommandBus(
                [
                    new CommandHandlerMiddleware(
                        new ClassNameExtractor(),
                        new InMemoryLocator([DummyCommand::class => $this->dummyHandler]),
                        new InvokeInflector()
                    )
                ]
            )
        );
    }
}
