<?php

namespace App\Algo;

require_once "vendor/autoload.php";

use App\Algo\Heap\Heap;
use App\Algo\Book;

function showMenu(){
    $bookCollection = new Heap();
    $choice = 0;
    while($choice != -1){
        echo "Que voulez vous faire?\n\n1/Ajouter un livre\n2/Modifier un livre\n3/Supprimer un livre\n4/Afficher les livres\n";
        $choice = intval(readline());
        switch($choice){
            case 1:
                echo "Vous avez choisi 'Ajouter un livre'\n";
                echo "Entrez le nom du livre: ";
                $bookName = readline();
                echo "\nEntrez la description du livre: ";
                $bookDescription = readline();
                echo "\nEntrez la disponibilité du livre (0 = indisponible 1 = disponible): ";
                $bookAvailability = intval(readline());
        
                $bookCollection->push(new Book($bookName,$bookDescription,$bookAvailability));
                var_dump($bookCollection);
                break;
            case 2:
                echo "Vous avez choisi 'Modifier un livre'\n";
                break;
            case 3:
                echo "Vous avez choisi 'Suppriimer un livre'\n";
                break;
            case 4:
                echo "Vous avez choisi 'Afficher les livres'\n";
                var_dump($bookCollection);
                break;
            case -1:
                echo "Au revoir! ;)";
                break;
            default:
                echo "Choix erroné. Entreé un chiffre parmis ceux proposés\n";
                break;
        }
    }
}

showMenu();