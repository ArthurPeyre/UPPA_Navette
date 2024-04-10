<?php
class Date {
    // Variables
    private $id_date;
    private $date;

    // Méthodes et fonctions
    public function __construct($idDate, $laDate) {
        $this->id_date = $idDate;
        $this->date = $laDate;
    }

    public function getIdDate() {
        return $this->id_date;
    }

    public function getDate() {
        return $this->date;
    }
}
?>