<?php
class Date{
    // Variables
    private $date;

    // Méthodes et fonctions
    public function __construct($laDate) {
        $this->date = $laDate;
    }

    public function getDate() {
        return $this->date;
    }
}
?>