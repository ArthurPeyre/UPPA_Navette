<?php
include_once('./class.gestionConnexion.php');
include_once('./class.station.php');

class StationDAO {
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

    public function creer(Station $laStation){
        $sql = "INSERT INTO `station` (`id`, `ville`, `lieu`) VALUES (:id, :ville, :lieu);";

        $stmt = $this->conn->prepare($sql);

        $id = $laStation->getId();
        $ville = $laStation->getVille();
        $lieu = $laStation->getLieu();

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':lieu', $lieu);
        
        $bool = ($stmt->execute());

        return $bool;
    }

    public function delete($stationid){
        $sql = "DELETE FROM `station` WHERE `station`.`id` = :id_Station" ;

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_Station', $stationid);
        
        $bool = ($stmt->execute());

        return $bool;
    }


}