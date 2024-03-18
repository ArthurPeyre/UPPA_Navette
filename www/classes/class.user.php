<?php 

class User{
    private int $id;
    private String $name, $firstname, $email, $phone, $administrative_residence, $password;

    public function __construct($theId, $theName, $theFirstname, $theMail, $thePhone, $theAdministrativeResidence, $thePassword){
        $this->id = $theId;
        $this->name = $theName;
        $this->firstname = $theFirstname;
        $this->email = $theMail ; 
        $this->phone = $thePhone ;
        $this->administrative_residence = $theAdministrativeResidence ;
        $this->password = $thePassword ;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getAdministrativeResidence(){
        return $this->administrative_residence;
    }
    public function getPassword(){
        return $this->password;
    }

    public function setId($theId){
        $this->id = $theId ;
    }

    public function setName($theName){
        $this->name = $theName ;
    }

    public function setFirstname($theFirstname){
        $this->firstname = $theFirstname ;
    }

    public function setEmail($theMail){
        $this->email = $theMail ;
    }

    public function setPhone($thePhone){
        $this->phone = $thePhone ;
    }

    public function setAdministrativeResidence($theAdministrativeResidence){
        $this->administrative_residence = $theAdministrativeResidence ;
    }
    public function setPassword($thePassword){
        $this->password = $thePassword ;
    }

}
?>