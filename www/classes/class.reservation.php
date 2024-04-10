<?php
class Reservation {
    // Variables
    private $id_trajet;
    private $id_utilisateur;
    private $id_lieuDepart;
    private $id_lieuArrivee;

    // Méthodes et fonctions
    public function __construct($idTrajet, $idUtilisateur, $idLieuDepart, $idLieuArrivee) {
        $this->id_trajet = $idTrajet;
        $this->id_utilisateur = $idUtilisateur;
        $this->id_lieuDepart = $idLieuDepart;
        $this->id_lieuArrivee = $idLieuArrivee;
    }

    // id_trajet
    public function getIdTrajet() {
        return $this->id_trajet;
    }

    // id_utilisateur
    public function getIdUtilisateur() {
        return $this->id_utilisateurr;
    }

    // id_lieuDepart
    public function getIdLieuDepart() {
        return $this->id_lieuDepart;
    }
    public function setIdLieuDepart($idLieuDepart) {
        $this->id_lieuDepart = $idLieuDepart;
    }

    // id_lieuArrivee
    public function getIdLieuArrivee() {
        return $this->id_lieuArrivee;
    }
    public function setIdLieuArrivee($idLieuArrivee) {
        $this->id_lieuArrivee = $idLieuArrivee;
    }
}
?> 