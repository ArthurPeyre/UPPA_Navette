<?php
    include_once('conn.php');

    include_once('./classes/class.gestionConnexion.php');

    include_once('./classes/class.date.php');
    include_once('./classes/class.dateDAO.php');

    include_once('./classes/class.horaire.php');
    include_once('./classes/class.horaireDAO.php');

    include_once('./classes/class.lieu.php');
    include_once('./classes/class.lieuDAO.php');

    include_once('./classes/class.reservation.php');
    include_once('./classes/class.reservationDAO.php');

    include_once('./classes/class.trajet.php');
    include_once('./classes/class.trajetDAO.php');

    include_once('./classes/class.utilisateur.php');
    include_once('./classes/class.utilisateurDAO.php');


    $conn = conn();

    session_start();

    if(!isset($_REQUEST['controleur']))
        $controleur = 'accueil';
    else {
        $controleur = $_REQUEST['controleur'];
    }
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
    
    <?php
        include_once('./vues/v_header.php');
    ?>

    <div id="app">
        
        <?php
            switch ($controleur) {
                case 'accueil':
                    include_once('./composants/reserver.php');
                    include_once('./composants/reservations.php');
                    include_once('./composants/profil.php');
                    break;
                
                default:
                    # code...
                    break;
            }
            
            close($conn);
        ?>
    
    </div>

</body>
</html>