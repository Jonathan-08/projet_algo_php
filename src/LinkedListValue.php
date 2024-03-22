<?php

namespace App\Algo\Data;

use App\Algo\Data\Book;
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
