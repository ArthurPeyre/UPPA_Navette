<?php
class LieuDAO {
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

    public function charger($idLieu) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM lieux WHERE id_lieu=:idLieu";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idLieu', $idLieu);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objLieu = new Lieu($tuple['id_lieu'], $tuple['ville'], $tuple['lieu']);
        
        return $objLieu;
    }

    public function supprimer(Lieu $objLieu) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM lieux WHERE id_lieu=:idLieu AND ville=:ville AND lieu=:lieu";

        $idLieu = $objLieu->getIdLieu();
        $ville = $objLieu->getVille();
        $lieu = $objLieu->getLieu();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idLieu', $idLieu);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':lieu', $lieu);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function creer(Lieu $objLieu) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "INSERT INTO lieux VALUES (:idLieu, :ville, :lieu);";

        $idLieu = $objLieu->getIdLieu();
        $ville = $objLieu->getVille();
        $lieu = $objLieu->getLieu();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idLieu', $idLieu);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':lieu', $lieu);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function sauvegarder(Lieu $objLieu) {
        // Modifie l'arrêt correspondant à l'objet passé en paramètre
        $sql = "UPDATE lieux SET ville=:ville, lieu=:lieu WHERE id_lieu=:idLieu;";

        $idLieu = $objLieu->getIdLieu();
        $ville = $objLieu->getVille();
        $lieu = $objLieu->getLieu();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idLieu', $idLieu);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':lieu', $lieu);

        $bool = ($stmt->execute());
        
        return $bool;
    }
}
?>