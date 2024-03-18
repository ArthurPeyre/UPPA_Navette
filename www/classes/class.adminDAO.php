<?php
include_once 'class.admin.php';
include_once 'class.gestionConnexion.php';
include_once 'class.userDAO.php';
class AdminDao{
    private $_db;
    public function setDb(PDO $db){
        $this->_db = $db;
    }
    
    public function __construct(){
       $monPDO=GestionConnexion::getConnection();
 	   $this->setDb($monPDO);
    }

    public function load($theId){
        $ok = false;
        $sql="Select ";

    }
}
?>