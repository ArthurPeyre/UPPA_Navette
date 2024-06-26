<?php
class UtilisateurDAO {
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

    // Renvoie l'objet Utilisateur correspondant à l'identifiant et mot de passe passés en paramètre
    public function charger($email, $mdp) {
        $sql = "SELECT * FROM utilisateurs WHERE email=:email";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $tuple = $stmt->fetch();

        if ($tuple != null) {
            if (password_verify($mdp, $tuple['password'])) {
                $result = new Utilisateur($tuple['id_utilisateur'], $tuple['nom'], $tuple['prenom'], $tuple['email'], $tuple['phone'], $tuple['password'], $tuple['type'], $tuple['residence_administrative'], $tuple['derniereConnexion']);
            }
        }

        return $result;
    }

    public function supprimer(Utilisateur $objUtilisateur) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM utilisateurs WHERE nom=:nom AND prenom=:prenom AND email=:email AND phone=:phone AND password=:password AND residence=:residence AND id_utilisateur=:idUtilisateur";

        $password = $objUtilisateur->getPassword(); // Le mot de passe à crypter
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $idUtilisateur = $objUtilisateur->getIdUtilisateur();
        $nom = $objUtilisateur->getNom();
        $prenom = $objUtilisateur->getPrenom();
        $email = $objUtilisateur->getEmail();
        $phone = $objUtilisateur->getPhone();
        $residence = $objUtilisateur->getResidenceAdministrative();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':residence', $residence);
        
        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function creer(Utilisateur $objUtilisateur) {
        // Supprime l'utilisateur correspondant à l'objet passé en paramètre
        $sql = "INSERT INTO utilisateurs VALUES (NULL, :nom, :prenom, :email, :phone, :password, 0, :residence, NOW());";

        $password = $objUtilisateur->getPassword(); // Le mot de passe à crypter
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $nom = $objUtilisateur->getNom();
        $prenom = $objUtilisateur->getPrenom();
        $email = $objUtilisateur->getEmail();
        $phone = $objUtilisateur->getPhone();
        $residence = $objUtilisateur->getResidenceAdministrative();

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':residence', $residence);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function sauvegarder(Utilisateur $objUtilisateur) {
        // modifie l'utilisateur correspondant à l'objet passé en paramètre
        
        $sql = "UPDATE utilisateurs SET nom=:nom, prenom=:prenom, email=:email, phone=:phone, residence_administrative=:residence WHERE id_utilisateur=:idUtilisateur;";

        //$password = $objUtilisateur->getPassword(); // Le mot de passe déjà crypté
        $idUtilisateur = $objUtilisateur->getIdUtilisateur();
        $nom = $objUtilisateur->getNom();
        $prenom = $objUtilisateur->getPrenom();
        $email = $objUtilisateur->getEmail();
        $phone = $objUtilisateur->getPhone();
        $residence = $objUtilisateur->getResidenceAdministrative();
/*
        echo $idUtilisateur;
        echo $nom;
        echo $prenom;*/

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        //$stmt->bindParam(':password', $password);
        $stmt->bindParam(':residence', $residence);

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function getLesProchainesReservations(Utilisateur $objUtilisateur) {
        $tabReservation = array();

        $sql = "SELECT * FROM reserver INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet INNER JOIN date ON trajets.id_date = date.id_date WHERE id_utilisateur=:idUtilisateur AND date.date>=:date";

        $idUtilisateur = $objUtilisateur->getIdUtilisateur();
        $date = date("Y-m-d");

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idUtilisateur', $idUtilisateur);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        $tuple = $stmt->fetch();

        while ($tuple != null) {
            $objReservation = new Reservation($tuple['id_trajet'], $tuple['id_utilisateur'], $tuple['id_lieuDepart'], $tuple['id_lieuArrivee']);
            array_push($tabReservation, $objReservation);

            $tuple = $stmt->fetch();
        }
        
        return $tabReservation;
    }

    public function estInscrit($email, $phone) {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateurs WHERE email=:email OR phone=:phone");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        $tuple = $stmt->fetch();

        $bool = ($tuple != null) ? true : false;

        return $bool;
    }
    public function getNbVisites(){
        $stmt = $this->conn->prepare("SELECT COUNT(*) as visites FROM utilisateurs WHERE derniereConnexion>=:date");
        
        $date = date('Y-m-01');
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        $Visites = $stmt->fetch();
        return $Visites;
    }
}
?>