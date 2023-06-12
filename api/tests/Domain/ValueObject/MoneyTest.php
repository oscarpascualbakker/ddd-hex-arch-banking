<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use src\Domain\ValueObject\Money;

class MoneyTest extends TestCase
{
    public function testMoneyCanBeConstructed()
    {
        $money = new Money(10.0);
        $this->assertInstanceOf(Money::class, $money);
    }

    public function testMoneyCannotBeNegative()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Money(-1.0);
    }

    public function testEqualsReturnsTrueWhenAmountsAreEqual()
    {
        $money1 = new Money(10.0);
        $money2 = new Money(10.0);

        $this->assertTrue($money1->equals($money2));
    }

    public function testEqualsReturnsFalseWhenAmountsAreNotEqual()
    {
        $money1 = new Money(10.0);
        $money2 = new Money(20.0);

        $this->assertFalse($money1->equals($money2));
    }

    public function testValueMethodReturnsCorrectAmount()
    {
        $money = new Money(10.0);
        $this->assertEquals(10.0, $money->value());
    }
}