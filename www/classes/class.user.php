<?php 

class User{
    private int $id;
    private String $nom, $prenom, $email, $telephone, $residenceAdministrative, $motDePasse;

    public function __construct($lId, $leNom, $lePrenom, $leMail, $leTelephone, $laResidenceAdministrative, $leMotDePasse){
        $this->id = $lId;
        $this->nom = $leNom;
        $this->prenom = $lePrenom;
        $this->email = $leMail ; 
        $this->telephone = $leTelephone ;
        $this->residenceAdministrative = $laResidenceAdministrative ;
        $this->motDePasse = $leMotDePasse ;
    }

    public function getId(){
        return $this->id;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function getResidenceAdministrative(){
        return $this->residenceAdministrative;
    }

    public function getMotDePasse(){
        return $this->motDePasse;
    }

    public function setId($lId){
        $this->id = $lId ;
    }

    public function setNom($leNom){
        $this->nom = $leNom ;
    }

    public function setPrenom($lePrenom){
        $this->prenom = $lePrenom ;
    }

    public function setEmail($leMail){
        $this->email = $leMail ;
    }

    public function setTelephone($leTelephone){
        $this->telephone = $leTelephone ;
    }

    public function setResidenceAdministrative($laResidenceAdministrative){
        $this->residenceAdministrative = $laResidenceAdministrative ;
    }

    public function setMotDePasse($leMotDePasse){
        $this->motDePasse = $leMotDePasse ;
    }
}
?>