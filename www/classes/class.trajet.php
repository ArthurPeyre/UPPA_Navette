<?php
class Trajet {
    // Variables
    private $id;
    private $date;
    private $horaire;
    private $direction;
    private $canceled = false;

    // Méthodes et fonctions
    public function __construct($id, $id_date, $id_horaire, $id_direction) {
        $this->id = $id;
        $this->date = $id_date;
        $this->horaire = $id_horaire;
        $this->direction = $id_direction;
    }

    public function getIdTrajet() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getHoraire() {
        return $this->horaire;
    }

    public function getDirection() {
        return $this->direction;
    }
}
?>