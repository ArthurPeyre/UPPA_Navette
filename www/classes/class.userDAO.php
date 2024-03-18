<?php
include_once 'class.gestionConnexion.php';
include_once 'class.user.php';

class UserDAO{
    private $conn
    ;
    public function setDb(PDO $db){
        $this->_db = $db;
    }
    
    public function __construct(){
       $monPDO=GestionConnexion::getConnection();
 	   $this->setDb($monPDO);
    }

    public function addReservation(Reservation $theReservation){
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO `reserver` (`id_trajet`, `id_utilisateur`, `id_lieuDepart`, `id_lieuArrivee`) VALUES (:id_trajet, :id_utilisateur, :id_lieuDepart, :id_lieuArrivee);";

        $stmt = $this->conn->prepare($sql);

        $idTraj = $theReservation->getIdTrajet() ;
        $idUtil = $theReservation->getIdUtilisateur() ;
        $lieuDep = $theReservation->getIdLieuDepart() ;
        $lieuArr = $theReservation->getIdLieuArrivee() ;

        $stmt->bindParam(':id_trajet', $idTraj);
        $stmt->bindParam(':id_utilisateur', $idUtil);
        $stmt->bindParam(':id_lieuDepart', $lieuDep);
        $stmt->bindParam(':id_lieuArrivee', $lieuArr);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function create(User $theUser){
        $sql = "INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `phone`, `password`, `residence_administrative`) VALUES (:id_utilisateur, :nom_utilisateur, :prenom_utilisateur, :email_utilisateur, :phone_utilisateur, :password_utilisateur, :ra_utilisateur);";

        $stmt = $this->conn->prepare($sql);

        $idUser = $theUser->getId();
        $nomUser = $theUser->getName();
        $prenomUser = $theUser->getFirstname();
        $emailUser = $theUser->getEmail();
        $phoneUser = $theUser->getPhone();
        $passwordUser = $theUser->getPassword();
        $raUser = $theUser->getAdministrativeResidence();
        

        $stmt->bindParam(':id_utilisateur', $idUser);
        $stmt->bindParam(':nom_utilisateur', $nomUser);
        $stmt->bindParam(':prenom_utilisateur', $prenomUser);
        $stmt->bindParam(':email_utilisateur', $emailUser);
        $stmt->bindParam(':phone_utilisateur', $phoneUser);
        $stmt->bindParam(':password_utilisateur', $passwordUser); 
        $stmt->bindParam(':ra_utilisateur', $raUser);    

        $bool = ($stmt->execute());

        return $bool;
    }





}

?>