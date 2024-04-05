<?php

namespace App\Algo\Heap;

use App\Algo\LinkedList;

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

    public function getLength(): int{
        
        if($this->first === null){
            return 0;
        }

        $count = 0;

        while($this->first !== null){
            $count++;
            $this->first = $this->first->next;
        }

        return $count;
    }
}