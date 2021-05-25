<?php
declare(strict_types=1);

namespace Demo;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBusUsingSymfonyMessenger implements CommandBus
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function handle(object $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (HandlerFailedException $e) {
            throw $e->getNestedExceptions()[0];
        } catch (NoHandlerForMessageException $e) {
            throw NoHandler::forCommand($command);
        }
    }
}
