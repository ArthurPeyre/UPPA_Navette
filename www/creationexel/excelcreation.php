<?php
require_once("./PHP_XLSXWriter-master/xlsxwriter.class.php");

$data = array(
    array('Aller', 'Retour', 'nombre'),
    array('Anglet', 'Pau', '10'),
    array('Anglet', 'Pau', '3'),
);

$writer = new XLSXWriter();
$writer->writeSheet($data);
$writer->writeToFile('php://output'); // Écriture du fichier dans la sortie HTTP

// En-têtes pour forcer le téléchargement
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="test.xlsx"');
header('Cache-Control: max-age=0');

// Flusher le tampon de sortie
flush();

?>