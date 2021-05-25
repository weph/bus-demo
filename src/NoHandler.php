<?php
declare(strict_types=1);

namespace Demo;

use Exception;

final class NoHandler extends Exception
{
    public static function forCommand(object $command): self
    {
        return new self('No handler found for ' . get_class($command));
    }
}
