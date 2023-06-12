<?php

declare(strict_types=1);

namespace src\Domain\ValueObject;


class Money
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->validate($amount);
        $this->amount = $amount;
    }

    public function add(Money $money): Money
    {
        return new Money($this->amount + $money->value());
    }

    public function equals(Money $amount): bool
    {
        return $this->amount === $amount->value();
    }

    public function validate($amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("Amount cannot be negative.");
        }
        return true;
    }

    public function value(): float
    {
        return $this->amount;
    }

    public function lessThan(Money $other): bool
    {
        return $this->amount < $other->value();
    }

    public function __toString(): string
    {
        return number_format($this->amount, 2);
    }
}
