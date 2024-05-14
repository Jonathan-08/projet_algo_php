<?php

namespace App\Algo\Heap;

use App\Algo\LinkedList;
use App\Algo\Book;
use App\Algo\LinkedListValue;

class Heap extends LinkedList{

    public function pop(): mixed
    {
        if ($this->first === null) {
            return null;
        }

        $first = $this->first;
        $next = $this->first->next;

        if ($next === null) {
            $this->first = null;

            return $first->value;
        }

        $this->first = $next;

        return $first->value;
    }
}