<?php

namespace App\Algo\Heap;

use App\Algo\LinkedList;
use App\Algo\Book;
use App\Algo\LinkedListValue;

class Heap extends LinkedList{

    public function toArray(): array {
        $booksArray = [];
        $current = $this->first;
    
        while ($current !== null) {
            $booksArray[] = $current->value;
            $current = $current->next;
        }
    
        return $booksArray;
    }

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

    public function getLength(): int {
        $count = 0;
        $current = $this->first; 
    
        while ($current !== null) {
            $count++;
            $current = $current->next;
        }
    
        return $count;
    }


    public function remove(Book $bookToRemove): void {
        $previous = null;
        $current = $this->first;
    
        while ($current !== null) {
            if ($current->value === $bookToRemove) {
                if ($previous === null) {
                    $this->first = $current->next;
                } else {
                    $previous->next = $current->next;
                }
                return;
            }
            $previous = $current;
            $current = $current->next;
        }
    }
    
    public function findByKey(string $searchKey): ?Book {
        $current = $this->first;
    
        while ($current !== null) {
            if ($current->value->name === $searchKey ||
                $current->value->description === $searchKey ||
                $current->value->id == $searchKey ||
                $current->value->available == $searchKey) {
                return $current->value;
            }
            $current = $current->next;
        }
    
        return null;
    }
}