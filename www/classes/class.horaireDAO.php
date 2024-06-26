<?php
class HoraireDAO {
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

    public function charger($idHoraire) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM horaire WHERE id_horaire=:idHoraire";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHoraire', $idHoraire);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objHoraire = new Horaire($tuple['id_horaire'], $tuple['heureDepart'], $tuple['heureArrivee']);
        
        return $objHoraire;
    }

    public function getLesHorairesDepart() {
        $tabHoraires = array();

        $sql = "SELECT * FROM horaire WHERE 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $tuple = $stmt->fetch();

        while ($tuple != null) {
            $objHoraire = new Horaire($tuple['id_horaire'], $tuple['heureDepart'], $tuple['heureArrivee']);
            array_push($tabHoraires, $objHoraire);

            $tuple = $stmt->fetch();
        }
        
        return $tabHoraires;
    }

    public function supprimer(Horaire $objHoraire) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM horaire WHERE id_horaire=:idHoraire AND heureDepart=:heureD AND heureArrivee=:heureA";

        $idHoraire = $objHoraire->getIdHoraire();
        $heureD = $objHoraire->getHeureDepart();
        $heureA = $objHoraire->getHeureArrivee();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHoraire', $idHoraire);
        $stmt->bindParam(':heureD', $heureD);
        $stmt->bindParam(':heureA', $heureA);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function creer(Horaire $objHoraire) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "INSERT INTO horaire VALUES (:idHoraire, :heureD, :heureA);";

        $idHoraire = $objHoraire->getIdHoraire();
        $heureD = $objHoraire->getHeureDepart();
        $heureA = $objHoraire->getHeureArrivee();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHoraire', $idHoraire);
        $stmt->bindParam(':heureD', $heureD);
        $stmt->bindParam(':heureA', $heureA);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function sauvegarder(Horaire $objHoraire) {
        // Modifie l'arrêt correspondant à l'objet passé en paramètre
        $sql = "UPDATE horaire SET heureDepart=:heureD, heureArrivee=:heureA WHERE id_horaire=:idHoraire;";

        $idHoraire = $objHoraire->getIdHoraire();
        $heureD = $objHoraire->getHeureDepart();
        $heureA = $objHoraire->getHeureArrivee();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idHoraire', $idHoraire);
        $stmt->bindParam(':heureD', $heureD);
        $stmt->bindParam(':heureA', $heureA);

        $bool = ($stmt->execute());
        
        return $bool;
    }
}
?>