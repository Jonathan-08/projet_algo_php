<?php
namespace App\Algo;

class Logger {

    private $logFile;



    public function __construct($logFile) {
        $this->logFile = $logFile;
    }

    public function log($message) {
        file_put_contents($this->logFile, $message . PHP_EOL, FILE_APPEND);
    }

    public function logBookAddition($bookName) {
        $this->log("Ajout d'un livre : $bookName ". "le :". date('l jS \of F Y h:i:s A'));
    }

    public function logBookModification($oldBookName, $newBookName) {
        $this->log("Modification du livre $oldBookName en $newBookName");
    }

    public function logBookDeletion($bookName) {
        $this->log("Suppression du livre : $bookName");
    }
    public function logSeeBooks() {
        $this->log("Affichage des livres");
    }
    public function logSeeOneBooks($bookName) {
        $this->log("Affichage d'un livre : $bookName");
        
    }

    public function logSortBooks() {
        $this->log("Tri des livres");
    }

    public function showLogs() {
        echo file_get_contents($this->logFile);
    }
    public function logSearchBook($bookName, $success) {
        $result = $success === true ? 'succès' : 'échec';
        $this->log("Recherche du livre : $bookName => $result.");
    }
    
}
