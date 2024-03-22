<?php

namespace App\Algo\Data;

class LinkedListValue
{
    public $value;
    public $next;

    public function __construct($value)
    {
        $this->value = $value;
        $this->next = null;
    }
}
