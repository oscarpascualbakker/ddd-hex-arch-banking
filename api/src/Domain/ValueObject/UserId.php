<?php

declare(strict_types=1);

namespace src\Domain\ValueObject;


class UserId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->validate($id);
        $this->id = $id;
    }

    public function equals(UserId $id): bool
    {
        return $this->id === $id->value();
    }

    public function validate($id)
    {
        // TODO: validar el UserId?
        return true;
    }

    public function value(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
