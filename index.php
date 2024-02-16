<?php
include_once('conn.php');

$conn = conn();

session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPA - Navette</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php include_once('/composants/header.php'); ?>

    <div id="app">
        
        <?php
        include_once('/composants/reserver.php');
        include_once('/composants/reservations.php');
        include_once('/composants/profil.php');
        
        close($conn);
        ?>
    
    </div>

</body>
</html>