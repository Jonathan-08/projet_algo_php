<?php

namespace App\Algo;

require_once "vendor/autoload.php";

use App\Algo\Heap\Heap;
use App\Algo\Book;
use App\Algo\Utils;

function readBooksFromJson(string $filename): array {
  

}


function writeBooksToJson(array $livres, string $filename): void {
    $jsonData = json_encode($livres, JSON_PRETTY_PRINT);
    file_put_contents($filename, $jsonData);
}





function showMenu()
{
    $filename = "data/livres.json";
    $bookCollection = new Heap();
    Utils::fill($bookCollection, $filename);

    var_dump($bookCollection);
  /*


    $choice = 0;
    while ($choice != -1) {
        echo "Que voulez vous faire?\n\n1/Ajouter un livre\n2/Modifier un livre\n3/Supprimer un livre\n4/Afficher les livres\n-1/Quitter\n";
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
                $nextId = $bookCollection->getLength() + 1;
                $book = new Book($bookName, $bookDescription, $bookAvailability, $nextId);
                $bookCollection->push($book);
                echo "Le livre $book->name a été ajouté avec succès.\n";
                writeBooksToJson($bookCollection->toArray(), $filename);
                break;
                case 2:
                    echo "Vous avez choisi 'Modifier un livre'\n";
                    echo "Entrez l'identifiant du livre à modifier: ";
                    $bookID = intval(readline());
                    


                    break;

                        
                
            case 3:

                echo "Vous avez choisi 'Supprimer un livre'\n";
                echo "Entrez le nom, la description, la disponibilité ou l'identifiant du livre que vous souhaitez supprimer : ";
                $searchKey = readline();
                $bookToRemove = $bookCollection->findByKey($searchKey);
                if ($bookToRemove !== null) {
                    $bookCollection->remove($bookToRemove);
                    echo "Le livre a été supprimé avec succès.\n";
                } else {
                    echo "Aucun livre correspondant n'a été trouvé.\n";
                }
                $filename = "data/livres.json";
                writeBooksToJson($bookCollection->toArray(), $filename);
                break;
            case 4:
                echo "Vous avez choisi 'Afficher les livres'\n";
                $bookCollection->showAllBooks();
              


                break;
            case -1:
                echo "Au revoir! ;)";
                break;
            default:
                echo "Choix erroné. Entrz un chiffre parmis ceux proposés.\n";
                break;
                }
        }*/
}

showMenu();
