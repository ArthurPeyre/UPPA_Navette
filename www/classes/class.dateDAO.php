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

    public function creerDate(Date $objDate) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO date VALUES (:date);";

        $stmt = $this->conn->prepare($sql);
        $laDate = $objDate->getDate();
        $stmt->bindParam(':id', $Id);
        $stmt->bindParam(':date', $laDate);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function supprimerDate(Date $objDate) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "DELETE date WHERE date=:date;";

        $stmt = $this->conn->prepare($sql);

        $laDate = $objDate->getDate();
        $stmt->bindParam(':date', $laDate);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function getToutesDates(){
        $toutesLesDates = array();
        $sql ="Select * From Date Where date >= NOW() order by date asc";
        $resultatRequete = $this->conn->query($sql);
        $leTuple = $resultatRequete->fetch(PDO::FETCH_ASSOC);
        while($leTuple!=NULL){
            $laDate = new Date($leTuple['date']);
            $toutesLesDates[] = $laDate;
            $leTuple = $resultatRequete->fetch(PDO::FETCH_ASSOC);
        }
        return $toutesLesDates;
    }
}
?>