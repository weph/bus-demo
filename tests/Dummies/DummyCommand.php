<?php
declare(strict_types=1);

namespace Tests\Demo\Dummies;

final class DummyCommand
{
    public bool $throwException;

    public function __construct(bool $throwException)
    {
        $this->throwException = $throwException;
    }

    public static function fail(): self
    {
        return new self(true);
    }

    public static function succeed(): self
    {
        return new self(false);
    }
}
