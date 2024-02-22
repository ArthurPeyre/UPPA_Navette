<?php
function conn() {      
    // Informations de connexion à la base de données
    $host = 'localhost'; // ou tout autre nom d'hôte
    $dbname = 'UPPA_navette';
    $username = 'root';
    $password = 'root';
    
    try {
        // Création d'une instance PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Définition du mode d'erreur PDO à Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // echo "Connexion à la base de données réussie.";
        
        return $conn; // Retourne l'objet PDO de la connexion
    } catch(PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        echo "Erreur de connexion : " . $e->getMessage();
        return null; // Retourne null en cas d'échec de connexion
    }
}

function close($conn) {
    $conn = null; // Ferme la connexion en assignant null à l'objet PDO
}
?>