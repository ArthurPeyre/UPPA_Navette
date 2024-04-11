<?php
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

    public function charger($idTrajet) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM trajets WHERE id_trajet=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $idTrajet);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);
        
        return $objTrajet;
    }

    public function getLeTrajet($idDate, $idHoraire, $idDirection) {
        $stmt = $this->conn->prepare("SELECT * FROM trajets WHERE id_date=:date AND id_horaire=:horaire AND id_direction=:direction");

        // Liage des valeurs
        $stmt->bindParam(':date', $idDate);
        $stmt->bindParam(':horaire', $idHoraire);
        $stmt->bindParam(':direction', $idDirection);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $tuple = $stmt->fetch();

        $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);

        return $objTrajet;
    }

    public function getNbReservations(Trajet $objTrajet) {
        
        $stmt = $this->conn->prepare("SELECT COUNT(*) as nbPersonnes FROM reserver WHERE id_trajet=:trajet");

        $idTrajet = $objTrajet->getIdTrajet();
        
        $stmt->bindParam(':trajet', $idTrajet);
        
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['nbPersonnes'];
    }

    public function creer(Trajet $objTrajet) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO trajets VALUES (:id, :id_date, :id_horaire, :id_direction);";

        $stmt = $_db->prepare($sql);

        $idTrajet = $objTrajet->getIdTrajet();
        $idDate = $objTrajet->getIdDate();
        $idHoraire = $objTrajet->getIdHoraire();
        $idDirection = $objTrajet->getIdDirection();

        $stmt->bindParam(':id', $idTrajet);
        $stmt->bindParam(':id_date', $idDate);
        $stmt->bindParam(':id_horaire', $idDHoraire);
        $stmt->bindParam(':id_direction', $idDirection);

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>