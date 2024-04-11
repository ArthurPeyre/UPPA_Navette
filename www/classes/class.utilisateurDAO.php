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

    public function supprimer(Arret $objArret) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
        $sql = "DELETE FROM lieux WHERE id_lieu=:idArret AND ville=:ville AND lieu=:lieu";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':idArret', $objArret->getIdArret());
        $stmt->bindParam(':ville', $objArret->getVille());
        $stmt->bindParam(':lieu', $objArret->getLieu());

        $bool = ($stmt->execute());
        
        return $bool;
    }

    public function creer(Utilisateur $objUtilisateur) {
        // Supprime l'arrêt correspondant à l'objet passé en paramètre
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

    public function sauvegarder(Arret $objArret) {
        // Modifie l'arrêt correspondant à l'objet passé en paramètre
        $sql = "UPDATE lieux SET ville=:ville, lieu=:lieu WHERE id_lieu=:idArret;";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ville', $objArret->getVille());
        $stmt->bindParam(':lieu', $objArret->getLieu());
        $stmt->bindParam(':idArret', $objArret->getIdArret());

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
}
?>