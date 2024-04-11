<?php
class Trajet {
    // Variables
    private $id_trajet;
    private $id_date;
    private $id_horaire;
    private $id_direction;

    // Méthodes et fonctions
    public function __construct($id, $id_date, $id_horaire, $id_direction) {
        $this->id_trajet = $id;
        $this->id_date = $id_date;
        $this->id_horaire = $id_horaire;
        $this->id_direction = $id_direction;
    }

    public function getIdTrajet() {
        return $this->id_trajet;
    }

    public function getIdDate() {
        return $this->id_date;
    }

    public function getIdHoraire() {
        return $this->id_horaire;
    }

    public function getIdDirection() {
        return $this->id_direction;
    }
}
?>