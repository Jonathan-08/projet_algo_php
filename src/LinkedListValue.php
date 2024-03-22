<?php

namespace App\Algo;

use App\Algo\Book;
class LinkedListValue
{
    public Book $value;
    public $next;

    public function __construct(Book $value)
    {
        $this->value = $value;
        $this->next = null;
    }
}
