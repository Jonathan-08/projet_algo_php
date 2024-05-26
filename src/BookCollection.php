<?php

namespace App\Algo;

use App\Algo\Heap\Heap;

class BookCollection extends Heap{
    public function __construct()
    {
        
    }

    /**
     * transform une BookCollection en tableu
     */
    public function toArray(): array {
        $booksArray = [];
        $current = $this->first;
    
        while ($current !== null) {
            $booksArray[] = $current->value;
            $current = $current->next;
        }
    
        return $booksArray;
    }

    /**
     * Récupère la longueur d'une BookCollection
     */
    public function getLength(): int {
        $count = 0;
        $current = $this->first; 
    
        while ($current !== null) {
            $count++;
            $current = $current->next;
        }
    
        return $count;
    }

    /**
     * Supprime un livre d'une BookCollection
     */
    public function remove($id) {
        $bookToRemove = $this->findById($id);

        if($this->first === null){
            echo "La liste est vide";
            return;
        }

        if($bookToRemove->value->id === $this->first->value->id){
            $bookRemoved = $this->pop();
            return $bookRemoved;
        }

        $beforeCurrent = $this->first;
        $current = $beforeCurrent->next;
        while($current !== null){
            if($current->value->id === $bookToRemove->value->id){
                $beforeCurrent->next = $current->next;
                $bookRemoved = $current;
                echo "HELLOOOOO";
                $current = null;
                return $bookRemoved;
            }

            if($current->next === null){
                $bookRemoved = $current;
                $beforeCurrent->next = null;
                return $bookRemoved;
            }
            $beforeCurrent = $current;
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

    public function getLastId()
    {
        $current = $this->first;
        $lastId = 0;

        while($current !== null){
            if($current->value->id > $lastId){
                $lastId = $current->value->id;
            }
            $current = $current->next;
        }

        return $lastId;

    }
    public function mergeSort($head, $property, $ascending = true) {
        if ($head === null || $head->next === null) {
            return $head;
        }

        $middle = $this->getMiddle($head);
        $nextOfMiddle = $middle->next;
        $middle->next = null;

        $left = $this->mergeSort($head, $property, $ascending);
        $right = $this->mergeSort($nextOfMiddle, $property, $ascending);

        $sortedList = $this->sortedMerge($left, $right, $property, $ascending);

        return $sortedList;
    }

    public function getMiddle($head) {
        if ($head === null) {
            return $head;
        }

        $slow = $head;
        $fast = $head->next;

        while ($fast !== null) {
            $fast = $fast->next;
            if ($fast !== null) {
                $slow = $slow->next;
                $fast = $fast->next;
            }
        }

        return $slow;
    }

    public function sortedMerge($a, $b, $property, $ascending) {
        if ($a === null) {
            return $b;
        }
        if ($b === null) {
            return $a;
        }

        $result = null;
        $comparison = $this->compare($a->value, $b->value, $property);
        if ($ascending ? $comparison <= 0 : $comparison > 0) {
            $result = $a;
            $result->next = $this->sortedMerge($a->next, $b, $property, $ascending);
        } else {
            $result = $b;
            $result->next = $this->sortedMerge($a, $b->next, $property, $ascending);
        }

        return $result;
    }

    public function compare($a, $b, $property) {
        if ($property == 'name') {
            return strcmp($a->name, $b->name);
        } elseif ($property == 'description') {
            return strcmp($a->description, $b->description);
        } elseif ($property == 'available') {
            return $a->available - $b->available;
        }
        return 0;
    }

    public function sortBooks($property, $ascending = true) {
        $this->first = $this->mergeSort($this->first, $property, $ascending);
    }
}