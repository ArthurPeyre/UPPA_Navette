<?php

class Station{
    private int $id;
    private String $ville;
    private String $lieu;

    public function __construct($lId,$laVille,$leLieu){
        $this->id = $lId;
        $this->ville = $laVille;
        $this->lieu = $leLieu;
 }

    public function getId(){
        return $this->id;
    }
    
    public function getVille(){
        return $this->ville;
    }

    public function getLieu(){
        return $this->lieu;
    }

    public function setId($lId){
        $this->id = $lId ;
    }
    
    public function setVille($laVille){
        $this->ville ;
    }

    public function setLieu($leLieu){
        $this->lieu = $leLieu;
    }
    
}