<?php declare(strict_types=1);

namespace App\LinkedList;

final class LinkedListNode
{
    public function __construct(
        public int|string $data,
        public ?LinkedListNode $next = null,
    ) {
    }
}