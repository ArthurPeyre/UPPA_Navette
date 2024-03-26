<?php
include_once('./class.gestionConnexion.php');
include_once('./class.trajet.php');

class TrajetDAO {
    // Variables
    private $_db;

    // Méthodes et fonctions
    public function setConnection(PDO $connection) {
        $this->_db = $connection;
    }

    public function __construct() {
        $monPDO=GestionConnexion::getConnection();
        $this->setConnection($monPDO);
    }

    public function loadByID($idTrajet) {
        // Renvoie l'objet Trajet correspondant à l'identifiant passé en paramètre
        $sql = "SELECT * FROM trajets WHERE id=:id";

        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':id', $idTrajet);
        $stmt->execute();

        $tuple = $stmt->fetch();

        $objTrajet = new Trajet($tuple['id_trajet'], $tuple['id_date'], $tuple['id_horaire'], $tuple['id_direction']);
        
        return $objTrajet;
    }

    public function createTrajet(Trajet $objTrajet) {
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO trajets VALUES (:id, :id_date, :id_horaire, :id_direction);";

        $stmt = $this->_db->prepare($sql);

        $id = $objTrajet->getIdTrajet();
        $stmt->bindParam(':id', $id);
        $date = $objTrajet->getDate();
        $stmt->bindParam(':id_date', $date);
        $horaire = $objTrajet->getHoraire();
        $stmt->bindParam(':id_horaire', $horaire);
        $direction = $objTrajet->getDirection();
        $stmt->bindParam(':id_direction', $direction);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function deleteTrajet(Trajet $objTrajet){
        $sql = "Insert into trajets Values (:id, :date, :horaire, :direction);";
        $stmt = $this->_db->prepare($sql);

        $id = $objTrajet->getIdTrajet();
        $stmt->bindParam(':id', $id);
        $date = $objTrajet->getDate();
        $stmt->bindParam(':id_date', $date);
        $horaire = $objTrajet->getHoraire();
        $stmt->bindParam(':id_horaire', $horaire);
        $direction = $objTrajet->getDirection();
        $stmt->bindParam(':id_direction', $direction);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function getToutLesTajets(){
        $sql = "SELECT * FROM trajets WHERE 1";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }
    
    public function getToutLesTajetsParIdDate($idDate){
        $sql = "SELECT * FROM trajets WHERE id_date=".$idDate."";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }

    
    public function getToutLesTajetsParIdHoraire($idHoraire){
        $sql = "SELECT * FROM trajets WHERE id_horaire=".$idHoraire."";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }

    public function getToutLesTajetsAnnules(){
        $sql = "SELECT * FROM trajets WHERE cancel= TRUE";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }

    public function getToutLesTajetsPasAnnules(){
        $sql = "SELECT * FROM trajets WHERE cancel= FALSE";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }

    
    public function getToutLesTajetsParIdDirection($idDirection){
        $sql = "SELECT * FROM trajets WHERE direction=".$idDirection."";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        $lesTuples = $stmt->fetchall(PDO::FETCH_ASSOC);
        $tabTrajets = array();
        foreach($lesTuples as $leTuple){
            $objTrajet = new Trajet($leTuple['id_trajet'], $leTuple['id_date'], $leTuple['id_horaire'], $leTuple['id_direction']);
            $tabTrajets[] = $objTrajet;
        }
        return $tabTrajets;
    }

    public function getToutesLesStations($idTrajet){
        $sql = "SELECT * FROM trajets WHERE id_trajet='".$idTrajet."'";
        $resultatRequete = $this->_db->query($sql);
        $leTuple = $resultatRequete->fetch(PDO::FETCH_ASSOC);
        $toutesLesStations = array();
        while($leTuple!=NULL){
            $laStation = new Station();
            $toutesLesStations[] = $laStation;
            $leTuple = $resultatRequete->fetch(PDO::FETCH_ASSOC);
        }
        return $toutesLesStations;
    }
}
?>