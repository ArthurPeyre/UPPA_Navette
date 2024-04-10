<?php
class Utilisateur {
    // Variables
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $phone;
    private $password;
    private $type;
    private $residence_administrative;
    private $derniereConnexion;

    // Constructeur
    public function __construct($id, $nom, $prenom, $email, $phone, $password, $type, $residence, $derniereConnexion) {
        $this->id_utilisateur = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->type = $type;
        $this->residence_administrative = $residence;
        $this->derniereConnexion = $derniereConnexion;
    }

    // Getter & Setter
    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type;
    }
    public function setType($type) {
        $this->type = $type;
    }

    public function getResidenceAdministrative() {
        return $this->residence_administrative;
    }
    public function setResidenceAdministrative($residence_administrative) {
        $this->residence_administrative = $residence_administrative;
    }

    public function getDerniereConnexion() {
        return $this->derniereConnexion;
    }
    public function setDerniereConnexion($derniereConnexion) {
        return $this->derniereConnexion = $derniereConnexion;
    }
}
?>