<?php

$array = [1,2,3];

echo "Que voulez vous faire?\n\n1/Ajouter un élément\n2/afficher les éléments\n";
$choice = intval(readline());

while($choice != -1){
    echo "Que voulez vous faire?\n\n1/Ajouter un élément\n2/afficher les éléments\n";
    $choice = intval(readline());
    switch($choice){
        case 1:
            echo "Vous avez choisi 'Ajouter un élément'\n";
            $pushedElement = intval(readline());
            array_push($array, $pushedElement);
            break;
        case 2:
            echo "Vous avez choisi 'afficher les éléments'\n";
            var_dump($array);
            break;
    }
}
