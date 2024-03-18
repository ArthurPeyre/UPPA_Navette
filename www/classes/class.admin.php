<?php
include_once 'class.user.php';

class Admin extends User{
    //Constructeur
    public function __construct($theId,$theName,$theFirstname,$theMail,$thePhone,$theAdministrativeResidence,$thePassword){
        parent::__construct($theId,$theName,$theFirstname,$theMail,$thePhone,$theAdministrativeResidence,$thePassword);
    }

    //Méthodes
}

?>