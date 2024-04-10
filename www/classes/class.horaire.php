<?php
class Horaire {
    // Variables
    private $id_horaire;
    private $heureDepart;
    private $heureArrivee;

    // Méthodes et fonctions
    public function __construct($id, $heureD, $heureA) {
        $this->id_horaire = $id;
        $this->heureDepart = $heureD;
        $this->heureArrivee = $heureA;
    }

    // id_lieu
    public function getIdHoraire() {
        return $this->id_horaire;
    }

    // ville
    public function getHeureDepart() {
        return $this->heureDepart;
    }
    public function setHeureDepart($heureD) {
        $this->heureDepart = $heureD;
    }

    // lieu
    public function getHeureArrivee() {
        return $this->heureArrivee;
    }
    public function setHeureArrivee($heureA) {
        $this->heureArrivee = $heureA;
    }
}
?>