<?php
include_once('./class.gestionConnexion.php');
include_once('./class.date.php');

class DateDAO {
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

    public function loadByID($idDate) {
        // Renvoie l'objet Date correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM date WHERE id_date=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idDate);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objDate = new Trajet($tuple['id_date'], $tuple['date']);
        
        return $objDate;
    }

    public function createDate(Date $objDate) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO date VALUES (:id, :date);";

        $stmt = $this->conn->prepare($sql);
        $Id = $objDate->getIdDate();
        $laDate = $objDate->getDate();
        $stmt->bindParam(':id', $Id);
        $stmt->bindParam(':date', $laDate);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function deleteDate(Date $objDate) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "DELETE date WHERE id_date=:id AND date=:date;";

        $stmt = $this->conn->prepare($sql);

        $Id = $objDate->getIdDate();
        $laDate = $objDate->getDate();
        $stmt->bindParam(':id', $Id);
        $stmt->bindParam(':date', $laDate);

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>