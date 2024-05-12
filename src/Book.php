<?php

namespace App\Algo;

class Book{
    public string $name;
    public string $description;
    public bool $available;
    public int $id;

    public function __construct($name, $description, $available, $id) 
    {
        $this->name = $name;
        $this->description = $description;
        $this->available = $available;
        $this->id = $id;
    }

}