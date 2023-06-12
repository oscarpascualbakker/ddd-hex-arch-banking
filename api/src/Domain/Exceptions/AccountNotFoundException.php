<?php

declare(strict_types=1);

namespace src\Domain\Exceptions;

use Exception;


class AccountNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Account not found.");
    }
}
