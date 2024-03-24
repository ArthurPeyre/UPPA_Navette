<?php
include_once 'class.gestionConnexion.php';
include_once 'class.user.php';

class UserDAO {
    private $conn;

    public function setDb(PDO $db){
        $this->conn = $db;
    }
    
    public function __construct(){
       $monPDO=GestionConnexion::getConnection();
 	   $this->setDb($monPDO);
    }

    public function addReservation(Reservation $laReservation){
        // Enregistre dans la base l'objet passé en paramètre
        $sql = "INSERT INTO `reserver` (`id_trajet`, `id_utilisateur`, `id_lieuDepart`, `id_lieuArrivee`) VALUES (:id_trajet, :id_utilisateur, :id_lieuDepart, :id_lieuArrivee);";

        $stmt = $this->conn->prepare($sql);

        $idTrajet = $laReservation->getIdTrajet() ;
        $idUtilisateur = $laReservation->getIdUtilisateur() ;
        $lieuDepart = $laReservation->getIdLieuDepart() ;
        $lieuArrivee = $laReservation->getIdLieuArrivee() ;

        $stmt->bindParam(':id_trajet', $idTrajet);
        $stmt->bindParam(':id_utilisateur', $idUtilisateur);
        $stmt->bindParam(':id_lieuDepart', $lieuDepart);
        $stmt->bindParam(':id_lieuArrivee', $lieuArrivee);

        $bool = ($stmt->execute());

        return $bool;
    }

    public function create(User $lUtilisateur){
        $sql = "INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `telephone`, `motDePasse`, `residenceAdministrative`) VALUES (:id_utilisateur, :nom_utilisateur, :prenom_utilisateur, :email_utilisateur, :telephone_utilisateur, :motDePasse_utilisateur, :residenceAdministrative_utilisateur);";

        $stmt = $this->conn->prepare($sql);
        
        $idUtilisateur = $lUtilisateur->getId();
        $nomUtilisateur = $lUtilisateur->getNom();
        $prenomUtilisateur = $lUtilisateur->getPrenom();
        $emailUtilisateur = $lUtilisateur->getEmail();
        $telephoneUtilisateur = $lUtilisateur->getTelephone();
        $motDePasseUtilisateur = $lUtilisateur->getMotDePasse();
        $residenceAdministrativeUtilisateur = $lUtilisateur->getResidenceAdministrative();
        

        $stmt->bindParam(':id_utilisateur', $idUtilisateur);
        $stmt->bindParam(':nom_utilisateur', $nomUtilisateur);
        $stmt->bindParam(':prenom_utilisateur', $prenomUtilisateur);
        $stmt->bindParam(':email_utilisateur', $emailUtilisateur);
        $stmt->bindParam(':telephone_utilisateur', $telephoneUtilisateur);
        $stmt->bindParam(':motDePasse_utilisateur', $motDePasseUtilisateur); 
        $stmt->bindParam(':residenceAdministrative_utilisateur', $residenceAdministrativeUtilisateur);    

        $bool = ($stmt->execute());

        return $bool;
    }
}
?>
