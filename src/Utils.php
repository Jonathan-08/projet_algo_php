<?php

namespace App\Algo;
use App\Algo\Heap\Heap;
use App\Algo\Book;

/**
 * Cette classe regroupe toutes les fonctions utilse au bon fonctionnement de la bookCollection
 */

class Utils{
    static function fetchBooksFromFile($filename){
        if(file_exists($filename)){
            $json_data = file_get_contents($filename);
            $data = json_decode($json_data, true);
            return $data;
        } else {
            die("Le fichier $filename n'existe pas");
        }
        
    }

    static function fill(Heap $bookCollection, $filename): void{
        $fetchedBooks = self::fetchBooksFromFile($filename);
        if(!empty($fetchedBooks) && $fetchedBooks !== NULL){
            foreach($fetchedBooks as $fetchedBook){
                $book = new Book($fetchedBook["name"], $fetchedBook["description"], $fetchedBook["available"], $fetchedBook["id"]);
                $bookCollection->push($book);
            }
        } else {
            die("Le fichier: $filename est vide.");
        }
    }
}