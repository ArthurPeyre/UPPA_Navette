<?php
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'formIdentification':
            if (!isset($_SESSION['Utilisateur'])) {
                include_once("vues/v_formIdentification.php");
            } else {
                header('Location: ./index.php?controleur=accueil');
            }
            break;

        case 'identification':
            if (!isset($_SESSION['Utilisateur']) && isset($_POST['formConn'])) {
                $objUtilisateurDAO = new UtilisateurDAO();
                $objUtilisateur = $objUtilisateurDAO->charger($_POST['txtemail'], $_POST['txtmdp']);
                if ($objUtilisateur != null) {
                    $_SESSION['Utilisateur'] = $objUtilisateur;
                } else {
                    header('Location: ./index.php?controleur=gererConnexion&action=formIdentification');
                }
            }
            header('Location: ./index.php?controleur=accueil');
            break;
        
        case 'formEnregistrement':
            if (!isset($_SESSION['Utilisateur'])) {
                include_once('vues/v_formEnregistrement.php');
            } else {
                header('Location: ./index.php?controleur=accueil');
            }
            break;

        case 'deconnexion':
            session_destroy();
            header("Location: ./index.php?controleur=accueil");
            break;
    }
?>