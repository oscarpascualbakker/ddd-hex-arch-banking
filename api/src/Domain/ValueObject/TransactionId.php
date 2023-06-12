<?php

declare(strict_types=1);

namespace src\Domain\ValueObject;


class TransactionId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->validate($id);
        $this->id = $id;
    }

    public function equals(TransactionId $id): bool
    {
        return $this->id === $id->value();
    }

    public function validate($id)
    {
        // TODO: validar el TransactionId?
        return true;
    }

    public function value(): string
    {
        return $this->id;
    }
}
