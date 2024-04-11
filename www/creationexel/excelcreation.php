<?php
require_once("./PHP_XLSXWriter-master/xlsxwriter.class.php");
    $data = array(
        array('Aller','Retour','nombre'),
        array('Anglet','Pau','10'),
        array('Anglet','Pau','3'),
    );
    $writer = new XLSXWriter();
    $writer->writeSheet($data);
    $writer->writeToFile('test.xlsx');
?>