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
        $objTrajet = null;

        $stmt = $this->conn->prepare("SELECT * FROM trajets WHERE id_date=:date AND id_horaire=:horaire AND id_direction=:direction");

        // Liage des valeurs
        $stmt->bindParam(':date', $idDate);
        $stmt->bindParam(':horaire', $idHoraire);
        $stmt->bindParam(':direction', $idDirection);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $tuple = $stmt->fetch();

        if ($tuple != null) $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);

        return $objTrajet;
    }

    public function getLesProchainsTrajets() {
        $tabTrajets = array();

        $stmt = $this->conn->prepare("SELECT trajets.* FROM trajets 
                                INNER JOIN date ON date.id_date = trajets.id_date 
                                INNER JOIN horaire ON horaire.id_horaire = trajets.id_horaire 
                                INNER JOIN directions ON directions.id_direction = trajets.id_direction
                                WHERE date.date >= NOW()
                                ORDER BY date.date, horaire.id_horaire, directions.id_direction;");
        $stmt->execute();
        $tuple = $stmt->fetch();

        while ($tuple != null) {
            $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);
            array_push($tabTrajets, $objTrajet);

            $tuple = $stmt->fetch();
        }
        
        return $tabTrajets;
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
        $sql = "INSERT INTO trajets VALUES (NULL, :id_date, :id_horaire, :id_direction);";

        $stmt = $this->conn->prepare($sql);

        $idDate = $objTrajet->getIdDate();
        $idHoraire = $objTrajet->getIdHoraire();
        $idDirection = $objTrajet->getIdDirection();

        $stmt->bindParam(':id_date', $idDate);
        $stmt->bindParam(':id_horaire', $idHoraire);
        $stmt->bindParam(':id_direction', $idDirection);

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>