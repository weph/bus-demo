<?php
declare(strict_types=1);

namespace Demo;

interface CommandBus
{
    public function handle(object $command): void;
}
