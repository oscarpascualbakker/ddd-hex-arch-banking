<?php

declare(strict_types=1);

namespace src\Infrastructure\Repository;

use src\Domain\Model\User;
use src\Domain\Repository\UserRepositoryInterface;


class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $user): void
    {
        $this->users[$user->getUserId()->value()] = $user;
    }

    public function findById(string $userId): ?User
    {
        return $this->users[$userId] ?? null;
    }

    public function all(): array
    {
        return $this->users;
    }
}
