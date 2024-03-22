<?php

namespace App\Algo\Data\Heap;

use App\Algo\Data\LinkedList;

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