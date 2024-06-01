## Projet pédagogique Algorithmie 3ème année

### Introduction
Nous sommmes embauché dans une société de numérisation de livres en ligne et vous avez la responsabilité de
créer un script en ligne de commande PHP permettant la gestion des livres d’une bibliothèque. Le script doit
proposer un menu permettant d’effectuer les différentes opérations listées ci-dessous.

#### Fonctionnalités
● Création de livre (1 point) : un utilisateur doit pouvoir ajouter un livre en ajoutant un nom, une
description et s’il est disponible en stock ou non avec un identifiant unique (auto-généré à la création).

● Modification d’un livre (1 point) : un utilisateur doit pouvoir modifier un livre, donc son nom, sa
description et s’il est toujours disponible en stock ou non.

● Suppression d’un livre (1 point) : un utilisateur doit pouvoir supprimer un livre via son nom, sa
description, s’il est disponible en stock ou non est son identifiant.

● Affichages des livres (1 point) : un utilisateur doit pouvoir afficher la liste des livres disponibles, donc
leurs nom, leurs description, et s’ils sont disponible en stock ou non.

● Affichage d’un livre (1 point) : un utilisateur doit pouvoir afficher les données d’un seul livre, donc son
nom, sa description, son identifiant et s’il est disponible en stock ou non.

● Tri de livres (4 points) : les livres doivent pouvoir être triés dans l’ordre croissant ou décroissant en
utilisant un tri fusion sur n’importe quelle colonne (une colonne à la fois), donc le nom, la description et
s’il est disponible en stock ou non.

● Recherche d’un livre (5 points): un utilisateur doit pouvoir rechercher un livre, la recherche doit se faire
sur une colonne, donc le nom, la description, s’il est disponible en stock et son identifiant. La recherche
se fait toujours sur une liste de livres triés dans l’ordre croissant en utilisant le tri rapide, la recherche
doit s’effectuer en utilisant une recherche binaire sur la colonne choisie.

#### Bonus
● Stockage des livres (2 points) : les livres doivent être stockés à chaque opération (hors tri et
recherche) dans un fichier JSON, et lors du démarrage du script, la liste doit être récupérée depuis ce
fichier JSON

● Historique (2 points) : un historique des actions effectuées (ajout, suppression, modification, liste, tri,
recherche) doit être tenu afin de pouvoir les consulter si besoin par l’utilisateur.

● Documentation et Clarté du Code (2 points) : présence de commentaires clairs et explicatifs dans le
code, respect des bonnes pratiques de codage en PHP.

### Exemple d’utilisation

Penser à utiliser composer pour installer les dépendances.

```shell
php index.php
```
```shell
Que voulez vous faire?

1/Ajouter un livre
2/Modifier un livre
3/Supprimer un livre
4/Afficher les livres
5/Afficher un livre
6/Afficher les logs
7/Trier les livres
8/Rechercher un livre
-1/Quitter

```

Les livres sont stockés dans un fichier livres.json.

Apres chaque action on veut constater l'historique des actions effectuées dans logs.csv.

### Contributeurs
- [ASSI Marc]() 3IW2
- [PERROUAS Thibault]() 3IW2
