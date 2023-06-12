<?php

declare(strict_types=1);

namespace Tests\Domain\ValueObject;

use src\Domain\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testUserIdCreation()
    {
        $userId = new UserId('user123');

        $this->assertInstanceOf(UserId::class, $userId);
        $this->assertEquals('user123', $userId->value());
    }

    public function testUserIdEquality()
    {
        $userId1 = new UserId('user123');
        $userId2 = new UserId('user123');
        $userId3 = new UserId('user124');

        $this->assertTrue($userId1->equals($userId2));
        $this->assertFalse($userId1->equals($userId3));
    }
}
