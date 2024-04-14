<?php
class ReservationDAO {
    // Variables
    private $conn;

    // Méthodes et fonctions
    public function setConnection(PDO $connection) {
        $this->conn = $connection;
    }

    public function __construct() {
        $monPDO=GestionConnexion::getConnexion();
        $this->setConnection($monPDO);
    }

    public function charger($idTrajet, $idUtilisateur) {
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

    public function estReservee($objTrajet, $objUtilisateur) {
        $stmt = $this->conn->prepare("SELECT * FROM reserver WHERE id_trajet=:trajet AND id_utilisateur=:user");

        $idTrajet = $objTrajet->getIdTrajet();
        $idUtilisateur = $objUtilisateur->getIdUtilisateur();

        $stmt->bindParam(':trajet', $idTrajet);
        $stmt->bindParam(':user', $idUtilisateur);

        $stmt->execute();

        $tuple = $stmt->fetch();

        $bool = ($tuple != null) ? true : false;

        return $bool;
    }

    public function creer(Reservation $objReservation) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO reserver VALUES (:id_trajet, :id_utilisateur, :id_lieuDepart, :id_lieuArrivee);";

        $stmt = $this->conn->prepare($sql);

        $idTrajet = $objReservation->getIdTrajet();
        $idUtilisateur = $objReservation->getIdUtilisateur();
        $idDepart = $objReservation->getIdLieuDepart();
        $idArrivee = $objReservation->getIdLieuArrivee();

        $stmt->bindParam(':id_trajet', $idTrajet);
        $stmt->bindParam(':id_utilisateur', $idUtilisateur);
        $stmt->bindParam(':id_lieuDepart', $idDepart);
        $stmt->bindParam(':id_lieuArrivee', $idArrivee);

        $bool = $stmt->execute();
    }

    public function supprimer($idTrajet, Utilisateur $objUtilisateur) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM reserver WHERE id_utilisateur=:idUser AND id_trajet=:idTrajet";

        $idUser = $objUtilisateur->getIdUtilisateur();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->bindParam(':idTrajet', $idTrajet);

        $bool = ($stmt->execute());
        
        return $bool;
    }
    public function getNbUtilisateurs(){
        //Renvoie le nombre d'utilisateurs
        $stmt = $this->conn->prepare("SELECT COUNT(DISTINCT reserver.id_utilisateur) AS users FROM reserver INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet INNER JOIN date ON trajets.id_date = date.id_date WHERE date.id_date >= :date");
        $date = date('Y-m-01');
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result; 
}

    public function getNbReservations() {
        //Renvoie le nombre de réservation
        $stmt = $this->conn->prepare("SELECT COUNT(*) as reservations FROM reserver INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet INNER JOIN date ON date.id_date = trajets.id_date WHERE date.date >= :date");
        $date = date('Y-m-01');
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['reservations'];  
}
    public function getRecurrence() {
        //Renvoie la recurrence des utilisateurs
        $sql = "SELECT AVG(reservations) AS recurrence FROM (
        SELECT COUNT(*) as reservations
        FROM reserver
        INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet
        INNER JOIN date ON trajets.id_date = date.id_date
        WHERE date.id_date >= :date
        GROUP BY reserver.id_utilisateur
        ) AS sous_requete";
        $date = date('Y-m-01'); 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ? number_format($result, 2) : 0;  
}
}
?> 