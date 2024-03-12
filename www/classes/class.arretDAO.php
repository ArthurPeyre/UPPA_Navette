<?php
include_once('./class.gestionConnexion.php');
include_once('./class.arret.php');

class ArretDAO {
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

    public function loadByID($idArret) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM lieux WHERE id_trajet=:idArret";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idArret', $idArret);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objArret = new Reservation($tuple['id_lieu'], $tuple['ville'], $tuple['lieu']);
        
        return $objArret;
    }

    public function deleteArret(Arret $objArret) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM lieux WHERE id_lieu=:idArret AND ville=:ville AND lieu=:lieu";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idArret', $objArret->getIdArret());
        $stmt->bindParam(':ville', $objArret->getVille());
        $stmt->bindParam(':lieu', $objArret->getLieu());

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function createArret(Arret $objArret) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "INSERT INTO lieux VALUES (:idArret, :ville, :lieu);";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idArret', $objArret->getIdArret());
        $stmt->bindParam(':ville', $objArret->getVille());
        $stmt->bindParam(':lieu', $objArret->getLieu());

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function updateArret(Arret $objArret) {
        // Modifie l'arrêt correspondant à l'objet passé en paramètre
        $sql = "UPDATE lieux SET ville=:ville, lieu=:lieu WHERE id_lieu=:idArret;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ville', $objArret->getVille());
        $stmt->bindParam(':lieu', $objArret->getLieu());
        $stmt->bindParam(':idArret', $objArret->getIdArret());

        $bool = ($stmt->execute());
        
        return $bool;
    }
}
?>