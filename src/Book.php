<?php

namespace App\Algo;

class Book{
    public string $name;
    public string $description;
    public bool $available;
    public int $id;

    public function __construct($name, $description, $available, $id = 0)
    {
        $this->name = $name;
        $this->description = $description;
        $this->available = $available;
        $this->id = $id;
    }

    public function setId(int $value): void{
        $this->id = $value;
    }
}