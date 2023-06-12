<?php

declare(strict_types=1);

namespace src\Domain\ValueObject;


class AccountId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->validate($id);
        $this->id = $id;
    }

    public function equals(AccountId $id): bool
    {
        return $this->id === $id->value();
    }

    public function validate($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException("AccountId cannot be empty.");
        }
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
