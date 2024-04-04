<?php
include_once('./class.gestionConnexion.php');
include_once('./class.reservation.php');

class ReservationDAO {
    // Variables
    private $conn;

    // Méthodes et fonctions
    public function setConnection(PDO $connection) {
        $this->conn = $connection;
    }

    public function __construct() {
        $monPDO=GestionConnexion::getConnection();
        $this->setConnection($monPDO);
    }

    public function loadByID($idTrajet, $idUtilisateur) {
        // Renvoie l'objet Reservation correspondant aux identifiants passés en paramètre
        $sql = "SELECT * FROM reserver WHERE id_trajet=:idTrajet AND id_utilisateur=:idUtilisateur";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idTrajet', $idTrajet);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objReservation = new Reservation($tuple['id_trajet'], $tuple['id_utilisateur'], $tuple['id_lieuDepart'], $tuple['id_lieuArrivee']);
        
        return $objReservation;
    }

    public function creerReservation(Reservation $objReservation) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO reserver VALUES (:id_trajet, :id_utilisateur, :id_lieuDepart, :id_lieuArrivee);";

        $stmt = $this->conn->prepare($sql);

        $id_trajet = $objReservation->getIdTrajet();
        $id_utilisateur = $objReservation->getIdUtilisateur();
        $id_lieuDepart = $objReservation->getIdLieuDepart();
        $id_lieuArrivee = $objReservation->getIdLieuArrivee();

        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':id_lieuDepart', $id_lieuDepart);
        $stmt->bindParam(':id_lieuArrivee', $id_lieuArrivee);


        $bool = ($stmt->execute());

        return $bool;
    }
}
?> 