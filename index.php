<?php

namespace App\Algo;

require_once "vendor/autoload.php";

use App\Algo\BookCollection;
use App\Algo\Book;
use App\Algo\Utils;
use App\Algo\Logger;


function writeBooksToJson(array $livres, string $filename): void
{
    $jsonData = json_encode($livres, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsonData);
}


function showMenu()
{
    $filename = "data/livres.json";
    $bookCollection = new BookCollection();
    Utils::fill($bookCollection, $filename);

    //var_dump($bookCollection);

    $logFile = "data/log.csv";
    $logger = new Logger($logFile);

    $choice = 0;
    while ($choice != -1) {
        echo "Que voulez vous faire?\n\n1/Ajouter un livre\n2/Modifier un livre\n3/Supprimer un livre\n4/Afficher les livres\n5/Afficher un livre\n6/Afficher les logs\n7/Trier les livres\n8/Rechercher un livre\n-1/Quitter\n";
        $choice = intval(readline());
        switch ($choice) {
            case 1:
                echo "Vous avez choisi 'Ajouter un livre'\n";
                echo "Entrez le nom du livre: ";
                $bookName = readline();
                echo "\nEntrez la description du livre: ";
                $bookDescription = readline();
                echo "\nEntrez la disponibilité du livre (0 = indisponible 1 = disponible): ";
                $bookAvailability = intval(readline());
                $nextId = uniqid();
                $book = new Book($bookName, $bookDescription, $bookAvailability, $nextId);
                $bookCollection->push($book);
                echo "Le livre $book->name a été ajouté avec succès avec l'ID $nextId.\n";
                writeBooksToJson($bookCollection->toArray(), $filename);

                $logger->logBookAddition($bookName);

                break;
            case 2:
                echo "Vous avez choisi 'Modifier un livre'\n";
                $searchBook = $bookCollection->binarySearch();
                $bookToModif = $searchBook["book"];
                if($bookToModif){
                    $bookName = $bookCollection->showSingleBook($bookToModif);
                    $bookCollection->modifBook($bookToModif);
                    writeBooksToJson($bookCollection->toArray(), $filename);
                    // recupérer le nom du livre modifié
                    
                    $logger->logBookModification($bookName);
                } else {
                    echo "Livre introuvable.\n";
                }
                break;
            case 3:
                echo "Vous avez choisi 'Supprimer un livre'\n";
                
                $searchBook = $bookCollection->binarySearch();
                $bookToRemove = $searchBook["book"];
                if($bookToRemove){
                    $removed = $bookCollection->remove($bookToRemove);
                    writeBooksToJson($bookCollection->toArray(), $filename);
                    $bookName = $removed->value->name;
                    echo "Le livre $bookName a bien été supprimé.\n";
                    $logger->logBookDeletion($bookName);
                }
                
                break;
            case 4:
                echo "Vous avez choisi 'Afficher les livres'\n";
                $bookCollection->showAllBooks();

                $logger->logSeeBooks();
                break;
            case 5:
                echo "Vous avez choisi 'Afficher un livre:'\n";
                $searchBook = $bookCollection->binarySearch();
                $book = $searchBook["book"];
                if($book){
                    $bookName = $bookCollection->showSingleBook($book);
                    $logger->logSeeOneBooks($bookName);
                }else{
                    echo "Livre introuvable.\n";
                }
                break;
            case 6:
                echo "Vous avez choisi 'Chercher un livre'\n";
                $searchBook = $bookCollection->binarySearch();
                $found = $searchBook["book"];
                $searchedName = $searchBook["bookName"];
                if($found){
                    $bookName = $bookCollection->showSingleBook($found);
                    $logger->logSearchBook($bookName, true);
                } else {
                    echo "Livre introuvable.\n";
                    $logger->logSearchBook($searchedName, $found);
                };
                break;
            case 6:
                echo "Vous avez choisi 'Afficher les logs'\n";
                $logger->showLogs();
                break;
            case 7:
                echo "Vous pouvez trier les livres par : \n1/ Nom\n2/ Description\n3/ Disponibilité\n";
                $sortChoice = intval(readline());
                echo "Choisissez l'ordre : \n1/ Croissant\n2/ Décroissant\n";
                $orderChoice = intval(readline());
                $ascending = ($orderChoice === 1);

                if ($sortChoice === 1) {
                    $bookCollection->sortBooks('name', $ascending);
                } elseif ($sortChoice === 2) {
                    $bookCollection->sortBooks('description', $ascending);
                } elseif ($sortChoice === 3) {
                    $bookCollection->sortBooks('available', $ascending);
                } else {
                    echo "Choix erroné. Entrez un chiffre parmi ceux proposés.\n";
                }

                // Afficher les livres triés
                $bookCollection->showAllBooks();

                $logger->logSortBooks();
                break;
            case -1:
                echo "Au revoir! ;)";
                break;
            default:
                echo "Choix erroné. Entrez un chiffre parmis ceux proposés.\n";
                break;
        }
    }
}

showMenu();
