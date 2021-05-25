<?php
declare(strict_types=1);

namespace Demo;

use League\Tactician\CommandBus as Tactician;
use League\Tactician\Exception\MissingHandlerException;

final class CommandBusUsingTactician implements CommandBus
{
    public function __construct(private Tactician $tactician)
    {
    }

    public function handle(object $command): void
    {
        try {
            $this->tactician->handle($command);
        } catch (MissingHandlerException $e) {
            throw NoHandler::forCommand($command);
        }
    }
}
