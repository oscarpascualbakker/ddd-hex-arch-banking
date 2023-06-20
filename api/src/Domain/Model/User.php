<?php

declare(strict_types=1);

namespace src\Domain\Model;

use src\Domain\ValueObject\UserId;


final class User
{
    private UserId $userId;
    private string $username;
    private string $password;
    private string $email;
    private \DateTimeImmutable $createdAt;

    public function __construct(UserId $userId, string $username, string $email, string $password, \DateTimeImmutable $createdAt)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->userId->value(),
            'name' => $this->username,
            'email' => $this->email,
            'createdAt' => $this->createdAt
        ];
    }


    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }


    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}