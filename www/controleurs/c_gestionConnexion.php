<?php
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'formIdentification':
            if (isset($_SESSION['Utilisateur'])) header('Location: ./index.php?controleur=accueil');
            include_once("vues/v_formIdentification.php");
            break;

        case 'identification':
            if (!isset($_SESSION['Utilisateur']) && isset($_POST['formConn'])) {
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
            if (isset($_SESSION['Utilisateur'])) header('Location: ./index.php?controleur=accueil');
            include_once('vues/v_formEnregistrement.php');
            break;

        case 'enregistrement':
            if (isset($_SESSION['Utilisateur'])) header('Location: ./index.php?controleur=accueil');
            if (!isset($_POST['formConn'])) header('Location: ./index.php?controleur=gererConnexion&action=formEnregistrement');

            // Si aucun compte n'est renvoyé
            if (!$objUtilisateurDAO->estInscrit($_POST['txtemail'], $_POST['phone'])) {

                $objUtilisateur = new Utilisateur(0, $_POST['txtnom'], $_POST['txtprenom'], $_POST['txtemail'], $_POST['phone'], $_POST['txtmdp'], 0, $_POST['residence'], null);

                // Si l'insertion a réussi
                if ($objUtilisateurDAO->creer($objUtilisateur)) {

                    $_SESSION['Utilisateur'] = $objUtilisateurDAO->charger($_POST['txtemail'], $_POST['txtmdp']);
                    
                    header('Location: index.php');
                } else {
                    echo "L'insertion a échouée...";
                }

            } else {
                echo "Cette adresse mail et/ou ce numéro de téléphone sont déjà utilisés...";
                header('Location: ./index.php?controleur=gererConnexion&action=formEnregistrement');
            }
            break;
            
        case 'profil':
            include_once('vues/v_profil.php');

            break;

        case 'modifProfil':
            $objUtilisateur = new Utilisateur($_SESSION['Utilisateur']->getIdUtilisateur(),$_POST['txtnom'],$_POST['txtprenom'],$_POST['txtemail'],$_POST['phone'],$_SESSION['Utilisateur']->getPassword(),$_SESSION['Utilisateur']->getType(),$_POST['residence'],$_SESSION['Utilisateur']->getDerniereConnexion());

            if($objUtilisateurDAO->sauvegarder($objUtilisateur)){
                echo "Modification réussie";
                $_SESSION['Utilisateur'] = $objUtilisateur;
            }else{
                echo "echec de la modification";
            }
            header('Location: ./index.php?controleur=gererConnexion&action=profil');

            break;


        case 'deconnexion':
            session_destroy();
            header("Location: ./index.php?controleur=accueil");
            break;
    }
?>