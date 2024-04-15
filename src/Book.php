<?php

namespace App\Algo;

class Book{
    public string $name;
    public string $description;
    public bool $available;
    public int $id;

    public function __construct($name, $description, $available)
    {
        $this->name = $name;
        $this->description = $description;
        $this->available = $available;
        $this->id = 0;
    }

    public function setId(int $value): void{
        $this->id = $value;
    }
}