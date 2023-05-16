<?php declare(strict_types=1);

namespace App\LinkedList;

final class LinkedList
{
    public function __construct(protected ?LinkedListNode $head = null)
    {
    }


    public function addValue(int|string $data): void
    {
        $linkedNode = new LinkedListNode($data);

        if ($this->head === null) {
            $this->head = $linkedNode;
            return;
        }

        if ($this->head->data > $data) {
            $linkedNode->next = $this->head;
            $this->head = $linkedNode;
            return;
        }

        $current = $this->head;

        while ($current->next !== null && $current->next->data < $data) {
            $current = $current->next;
        }

        $linkedNode->next = $current->next;
        $current->next = $linkedNode;
    }


    /**
     * @return array<int, int|string>
     */
    public function getValues(): array
    {
        $values = [];

        $current = $this->head;

        while ($current !== null) {
            $values[] = $current->data;
            $current = $current->next;
        }

        return $values;
    }
}