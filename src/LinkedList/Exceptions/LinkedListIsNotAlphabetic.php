<?php

namespace App\LinkedList\Exceptions;

use Exception;
use Throwable;

final class LinkedListIsNotAlphabetic extends Exception
{
    public function __construct(
        string $message = 'Value should be an alphabetic character(s).',
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}