<?php
declare(strict_types=1);

namespace Tests\Demo\Dummies;

final class DummyHandler
{
    public bool $invoked = false;

    /**
     * @throws DummyException
     */
    public function __invoke(DummyCommand $command): void
    {
        $this->invoked = true;

        if ($command->throwException) {
            throw new DummyException();
        }
    }
}
