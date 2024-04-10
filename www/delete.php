<?php
include_once('conn.php');

$conn = conn();

session_start();

if (!isset($_SESSION['id_utilisateur']) || !isset($_GET['id_trajet'])) header("Location: index.php");


// Requête préparée pour la sélection
$stmt = $conn->prepare("DELETE FROM reserver WHERE id_trajet=:trajet AND id_utilisateur=:user");

// Liage des valeurs
$stmt->bindParam(':trajet', $_GET['id_trajet']);
$stmt->bindParam(':user', $_SESSION['id_utilisateur']);

// Exécution de la requête
$stmt->execute();

header("Location: index.php");

close($conn);
?>