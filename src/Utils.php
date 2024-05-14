<?php

namespace App\Algo;
use App\Algo\Heap\Heap;
use App\Algo\Book;

class Utils{
    static function fetchBooksFromFile($filename){
        $json_data = file_get_contents($filename);
        $data = json_decode($json_data, true);
        return $data;
    }

    static function fill(Heap $bookCollection, $filename): void{
        $fetchedBooks = self::fetchBooksFromFile($filename);
        foreach($fetchedBooks as $fetchedBook){
        $book = new Book($fetchedBook["name"], $fetchedBook["description"], $fetchedBook["available"], $fetchedBook["id"]);
        $bookCollection->push($book);
        }
    }
}