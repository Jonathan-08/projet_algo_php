<?php

namespace App\Algo;

use App\Algo\Heap\Heap;

class BookCollection extends Heap{
    public function __construct()
    {
        
    }

    /**
     * transforme une BookCollection en tableau
     * @return array
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
     * @return int
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
     * @return ?LinkedListValue
     */
    public function remove(LinkedListValue $bookToRemove): LinkedListValue | null {

        if($this->first === null){
            echo "La liste est vide";
            return null;
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
     * @return ?LinkedListValue
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

    /**
     * Affiche un Book et retourne son nom
     * @param LinkedListValue
     * @return LinkedListValue
     */
    public function showSingleBook(LinkedListValue $bookValue): string{
        $bookAvailable = $bookValue->value->available ? "Disponible" : "Indisponible";
        echo "Nom du livre: {$bookValue->value->name}\nDescription: {$bookValue->value->description}\nDisponibilité: $bookAvailable\n";
        $bookName = $bookValue->value->name;
        return $bookName;
    }

    /**
     * Affiche tout les livres de la bibliothèque
     * @return void
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
     * @param LinkedListValue
     * @return void
     */
    public function modifBook(LinkedListValue $bookValue): void{
        echo "Nouveau nom: ";
        $bookValue->value->name = readline();
        echo "Nouvelle description nom: ";
        $bookValue->value->description = readline();
        echo "Nouvelle disponibilité: ";
        $bookValue->value->available = intval(readline());
    }

    /**
     * Retourne l'id du dernier élément
     * @return int
     */
    public function getLastId(): int
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

    /**
     * Fonction en point d'entrée qui appelle la fonction de tri
     */
    public function sort($column) {
        $this->first = $this->quickSort($this->first, $column);
    }

    /**
     * Fonction qui implémente le tri rapide
     */
    private function quickSort($first, $column) {
        if ($first === null || $first->next === null) {
            return $first;
        }

        list($pivot, $left, $right) = $this->partition($first, $column);

        $sortedLeft = $this->quickSort($left, $column);
        $sortedRight = $this->quickSort($right, $column);

        return $this->concatenate($sortedLeft, $pivot, $sortedRight);
    }

    /**
     * Fonction qui permet de séparer une liste en deux parties par rapport à son pivot
     */
    private function partition($first, $column) {
        $pivot = $first;
        $left = null;
        $right = null;

        $current = $first->next;
        while ($current !== null) {
            if ($current->value->$column < $pivot->value->$column) {
                $currentNext = $current->next;
                $current->next = $left;
                $left = $current;
                $current = $currentNext;
            } else {
                $currentNext = $current->next;
                $current->next = $right;
                $right = $current;
                $current = $currentNext;
            }
        }

        $pivot->next = null;

        return [$pivot, $left, $right];
    }

    /**
     * rassemble toutes les parties de la liste
     */
    private function concatenate($left, $pivot, $right) {
        if ($left === null) {
            $pivot->next = $right;
            return $pivot;
        }

        $current = $left;
        while ($current->next !== null) {
            $current = $current->next;
        }
        $current->next = $pivot;
        $pivot->next = $right;

        return $left;
    }

    /**
     * Fonction point d'entrée qui appelle la fonction de recherche binaire
     * @return LinkedListvalue
     */
    public function binarySearch(): LinkedListValue | bool{
        $column = $this->columnAsker();
        $this->sort($column);
        $target = $this->valueAsker($column);
        return $this->binarySearchHelper($this->first, null, $column, $target);
    }

    /**
     * Fonction qui implémente la recherche binaire
     */
    private function binarySearchHelper($start, $end, $column, $target): LinkedListValue | bool{
        if ($start === null) {
            return false;
        }

        $middle = $this->getMiddle($start, $end);

        if ($middle === null) {
            return false;
        }

        if ($middle->value->$column == $target) {
            return $middle;
        } elseif ($middle->value->$column < $target) {
            return $this->binarySearchHelper($middle->next, $end, $column, $target);
        } else {
            return $this->binarySearchHelper($start, $middle, $column, $target);
        }
    }

    /**
     * Retourne le milieu d'une liste chainée
     * @return ?LinkedListValue
     */
    private function getMiddle($start, $end): LinkedListValue | null{
        if ($start === null) {
            return null;
        }

        $slow = $start;
        $fast = $start->next;

        while ($fast !== $end) {
            if($fast === null){
                return null;
            }
            $fast = $fast->next;
            if ($fast !== $end) {
                $slow = $slow->next;
                $fast = $fast->next;
            }
        }

        return $slow;
    }

    /**
     * Demande sur quelle colonne la recherche sera effectué
     */
    public function columnAsker(){
        $choice = 0;
        $choices = [1, 2, 3, 4];
        while(!in_array($choice, $choices)){
            echo "Sur quelle colonne voulez-vous faire votre recherche?\n";
            echo "1/Nom\n2/Description\n3/Disponibilité\n4/Identifiant\n";
            $choice = intval(readline());
            //faire en sorte de recommencer le switch tant que le choix n'est pas bon
            switch ($choice) {
                case 1:
                    return "name";
                    break;
                case 2:
                    return "description";
                    break;
                case 3:
                    return "available";
                    break;
                case 4:
                    return "id";
                    break;
                default:
                    echo "Veuillez choisir parmis les options proposés\n";
                    break;
            }
        } 
    }

    /**
     * Formule la bonne question en fonction de la colonne renseignée
     */
    public function valueAsker($column){
        switch ($column) {
            case 'name':
                echo "Entrez le nom du livre recherché: ";
                return readline();
                break;

            case 'description':
                echo "Entrez la description du livre recherché: ";
                return readline();
                break;

            case 'availability':
                echo 'Entrez la disponibilité du livre recherché (0 ou 1): ';
                return readline();
                break;

            case 'id':
                echo "Entrez l'id du livre recherché: ";
                return readline();
                break;
        }
    }
}