<?php

declare(strict_types=1);

namespace src\Domain\Exceptions;

use Exception;


class InsufficientFundsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Insufficient funds to complete the transaction.");
    }
}
