<?php

namespace App\LinkedList\Exceptions;

use Exception;
use Throwable;

final class LinkedListIsNotInteger extends Exception
{
    public function __construct(
        string $message = 'Value should be an integer.',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}