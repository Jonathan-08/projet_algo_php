<?php

namespace App\Algo;

class Book{
    public string $name;
    public string $description;
    public bool $available;
    public string $id;

    public function __construct($name, $description, $available)
    {
        $this->name = $name;
        $this->description = $description;
        $this->available = $available;
        $this->id = bin2hex(random_bytes(4));
    }
}