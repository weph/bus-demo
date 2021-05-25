<?php
declare(strict_types=1);

namespace Tests\Demo;

use Demo\CommandBus;
use Demo\CommandBusUsingSymfonyMessenger;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Tests\Demo\Dummies\DummyCommand;

/**
 * @covers \Demo\CommandBusUsingSymfonyMessenger
 */
final class CommandBusUsingSymfonyMessengerTest extends CommandBusTest
{
    private CommandBusUsingSymfonyMessenger $subject;

    protected function commandBus(): CommandBus
    {
        return $this->subject;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new CommandBusUsingSymfonyMessenger(
            new MessageBus(
                [
                    new HandleMessageMiddleware(
                        new HandlersLocator(
                            [
                                DummyCommand::class => [$this->dummyHandler],
                            ]
                        )
                    ),
                ]
            )
        );
    }
}
