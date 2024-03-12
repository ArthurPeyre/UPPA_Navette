<?php
class Trajet {
    // Variables
    private $id;
    private $id_date;
    private $id_horaire;
    private $id_direction;

    // Méthodes et fonctions
    public function __construct($id, $id_date, $id_horaire, $id_direction, $nbPassagers) {
        $this->id = $id;
        $this->id_date = $id_date;
        $this->id_horaire = $id_horaire;
        $this->id_direction = $id_direction;
        $this->nbPassagers = $nbPassagers;
    }

    public function getIdTrajet() {
        return $this->id;
    }

    public function getIdDate() {
        return $this->id_date;
    }

    public function getIdHoraire() {
        return $this->horaire;
    }

    public function getIdDirection() {
        return $this->id_direction;
    }
}
?>