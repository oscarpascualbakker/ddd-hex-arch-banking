<?php

declare(strict_types=1);

namespace src\Application\Service;

use src\Domain\Model\User;
use src\Domain\ValueObject\UserId;
use src\Domain\Repository\UserRepositoryInterface;

class CreateUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $name, string $email, string $password): User
    {
        $userId = new UserId(uniqid());
        $createdAt = new \DateTimeImmutable();
        $user = new User($userId, $name, $email, $password, $createdAt);

        $this->userRepository->save($user);

        return $user;
    }
}
