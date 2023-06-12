<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use src\Domain\Repository\AccountRepositoryInterface;
use src\Domain\Repository\UserRepositoryInterface;

use src\Infrastructure\Repository\InMemoryAccountRepository;
use src\Infrastructure\Repository\InMemoryUserRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AccountRepositoryInterface::class,
            InMemoryAccountRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            InMemoryUserRepository::class
        );
        $this->app->bind(
            TransactionRepositoryInterface::class,
            InMemoryTransactionRepository::class
        );
    }
}
