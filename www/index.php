<?php

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
    include_once('./classes/class.utilisateurDAO.php');;
    
    $objTrajetDAO = new TrajetDAO();
    $objDateDAO = new DateDAO();
    $objHoraireDAO = new HoraireDAO();
    $objUtilisateurDAO = new UtilisateurDAO();
    $objReservationDAO = new ReservationDAO();
    $objLieuDAO = new LieuDAO();

    session_start();

    // Définit le fuseau horaire à utiliser
    date_default_timezone_set('Europe/Paris');

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
    <title>NavConnect - Transports en commun de l'Université de Pau et des Pays de l'Adour</title>

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
                    include_once('./vues/v_formReservation.php');
                    include_once('./vues/v_mesReservations.php');
                   
                    break;
                
                case 'gererConnexion':
                    include_once('./controleurs/c_gestionConnexion.php');
                    break;

                case 'gererReservations':
                    include_once('./controleurs/c_gestionReservation.php');
                    break;

                case 'admin':
                    include_once('./controleurs/c_admin.php');
                    break;
                
                default:
                    header('Location: ./index.php?controleur=accueil');
                    break;
            }
        ?>
    
    </div>

</body>
</html>