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
}

?>