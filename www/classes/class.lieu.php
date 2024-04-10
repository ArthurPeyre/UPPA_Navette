<?php
class Lieu {
    // Variables
    private $id_lieu;
    private $ville;
    private $lieu;

    // Méthodes et fonctions
    public function __construct($id, $ville, $lieu) {
        $this->id_lieu = $id;
        $this->ville = $ville;
        $this->lieu = $lieu;
    }

    // id_lieu
    public function getIdLieu() {
        return $this->id_lieu;
    }

    // ville
    public function getVille() {
        return $this->ville;
    }
    public function setVille($ville) {
        $this->ville = $ville;
    }

    // lieu
    public function getLieu() {
        return $this->lieu;
    }
    public function setLieu($lieu) {
        $this->lieu = $lieu;
    }
}
?>