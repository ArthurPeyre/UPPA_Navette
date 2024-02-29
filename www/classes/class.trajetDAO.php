<?php
include_once('./class.gestionConnexion.php');
include_once('./class.trajet.php');

class TrajetDAO {
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

    public function loadByID($idTrajet) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passée en paramètre
        $sql = "SELECT * FROM trajets WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idTrajet);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);
        
        return $objTrajet;
    }

    public function insertTrajet(Trajet $objTrajet) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO trajets VALUES (:id, :id_date, :id_horaire, :id_direction);";

        $stmt = $_db->prepare($sql);

        $stmt->bindParam(':id', $objTrajet->getIdTrajet());
        $stmt->bindParam(':id_date', $objTrajet->getIdDate());
        $stmt->bindParam(':id_horaire', $objTrajet->getIdHoraire());
        $stmt->bindParam(':id_direction', $objTrajet->getIdDirection());

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>