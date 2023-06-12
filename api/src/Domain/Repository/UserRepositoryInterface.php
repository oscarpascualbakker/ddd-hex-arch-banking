<?php

declare(strict_types=1);

namespace src\Domain\Repository;

use src\Domain\Model\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findById(string $userId): ?User;
}