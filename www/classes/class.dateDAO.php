<?php
class DateDAO {
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

    public function charger($idDate) {
        // Renvoie l'objet Date correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM date WHERE id_date=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idDate);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objDate = new Date($tuple['id_date'], $tuple['date']);
        
        return $objDate;
    }

    public function getLesProchainesDates() {
        $tabDates = array();

        $sql = "SELECT * FROM date WHERE date > :date ORDER BY date";

      

        $tomorrow = date("Y-m-d", strtotime("+1 day"));

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':date', $tomorrow);
        
        $stmt->execute();

        $tuple = $stmt->fetch();

        while ($tuple != null) {
            $objDate = new Date($tuple['id_date'],$tuple['date']);
            
            array_push($tabDates, $objDate);

            $tuple = $stmt->fetch();
        }
        
        return $tabDates;
        
    }

    public function creer(Date $objDate) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO date VALUES (NULL, :date);";

        $stmt = $this->conn->prepare($sql);

        $laDate = $objDate->getDate();
        
        $stmt->bindParam(':date', $laDate);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function supprimer($id) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "DELETE FROM date WHERE id_date=:id ";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>