<?php

namespace App\Algo;
use App\Algo\LinkedListValue;

class LinkedList
{
    public $first;

    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->first = new LinkedListValue($value);
        }
    }

    public function push(Book $value)
    {
        if ($this->first === null) {
            $this->first = new LinkedListValue($value);
            return;
        }

        $item = $this->first;

        while ($item->next !== null) {
            $item = $item->next;
        }

        $item->next = new LinkedListValue($value);
    }
}