<?php

namespace App\Algo;

use App\Algo\Heap\Heap;

class BookCollection extends Heap{
    public function __construct()
    {
        
    }

    public function toArray(): array {
        $booksArray = [];
        $current = $this->first;
    
        while ($current !== null) {
            $booksArray[] = $current->value;
            $current = $current->next;
        }
    
        return $booksArray;
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

    // à revoir
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
    
    // à revoir
    public function findByKey(string $searchKey): LinkedListValue | null {
        $current = $this->first;
    
        while ($current !== null) {
            if ($current->value->name === $searchKey ||
                $current->value->description === $searchKey ||
                $current->value->id == $searchKey ||
                $current->value->available == $searchKey) {
                return $current;
            }
            $current = $current->next;
        }
    
        echo "l'élément n'a pas été trouvé";
        return null;
    }

    /**
     * Trouve un livre en fonction de son Id.
     * Retourne null si l'id n'est pas trouvé
     */
    public function findById(int $id): LinkedListValue | null{
        $current = $this->first;

        while($current !== null){
            if($current->value->id === $id){
                return $current;
            }
            $current = $current->next;
        }

        echo "l'élément n'a pas été retrouvé.";
        return null;
    }

    public function showSingleBook(LinkedListValue $bookValue): string{
        $bookAvailable = $bookValue->value->available ? "Disponible" : "Indisponible";
        echo "Nom du livre: {$bookValue->value->name}\nDescription: {$bookValue->value->description}\nDisponibilité: $bookAvailable\n";
        $bookName = $bookValue->value->name;
        return $bookName;
    }

    /**
     * Affiche tout les livres de la bibliothèque
     */
    public function showAllBooks(): void{
        $current = $this->first;

        if($this->first === null){
            echo "La bibliothèque est vide\n";
        }

        while($current !== null){
            $bookAvailable = $current->value->available ? "Disponible" : "Indisponible";
            echo "Nom du livre: {$current->value->name}\nDescription: {$current->value->description}\nDisponibilité: {$bookAvailable}\n\n";
            $current = $current->next;
        }
    }

    /**
     * Modifie un livre de la bibliothèque
     */
    public function modifBook(LinkedListValue $bookValue): void{
        echo "Nouveau nom: ";
        $bookValue->value->name = readline();
        echo "Nouvelle description nom: ";
        $bookValue->value->description = readline();
        echo "Nouvelle disponibilité: ";
        $bookValue->value->available = intval(readline());
    }
}