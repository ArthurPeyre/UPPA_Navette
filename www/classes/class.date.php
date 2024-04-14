<?php
class Date {
    // Variables
    private $id_date = NULL;
    private $date;

    // Méthodes et fonctions
    public function __construct($laDate) {
        
        $this->date = $laDate;
    }

    public function getIdDate() {
        return $this->id_date;
    }
    
    public function setIdDate($idDate) {
        $this->id_date = $idDate;
    }

    public function getDate() {
        return $this->date;
    }
}
?>