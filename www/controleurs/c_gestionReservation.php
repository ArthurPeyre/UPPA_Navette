<?php

    $action = $_REQUEST['action'];

    switch ($action) {
        case 'reserver':
            if (isset($_SESSION['Utilisateur'])) {
                if (isset($_POST['formReserver'])) {
                    $direction = ($_POST['depart'] < $_POST['arrivee']) ? 1 : 2;

    
                    $objTrajet = $objTrajetDAO->getLeTrajet($_POST['lstDate'], $_POST['lstHoraire'], $direction);
    
                    // Si aucun tuple n'est renvoyé
                    if (!$objTrajet) {
    
                        $objTrajet = new Trajet(null, $_POST['lstDate'], $_POST['lstHoraire'], $direction);

                        echo "trajet inexistant, ";
    
                        if ($objTrajetDAO->creer($objTrajet)) {
    
                            $objTrajet = $objTrajetDAO->getLeTrajet($_POST['lstDate'], $_POST['lstHoraire'], $direction);
                            
                            $objReservation = new Reservation($objTrajet->getIdTrajet(), $_SESSION['Utilisateur']->getIdUtilisateur(), $_POST['depart'], $_POST['arrivee']);
                            $objReservationDAO->creer($objReservation);

                            echo "création réussi";
                        } else {
                            echo "echec de la création";
                        }
                    } else {
                        echo "trajet existe, ";
                        if (!$objReservationDAO->estReservee($objTrajet, $_SESSION['Utilisateur'])) {

                            $objReservation = new Reservation($objTrajet->getIdTrajet(), $_SESSION['Utilisateur']->getIdUtilisateur(), $_POST['depart'], $_POST['arrivee']);
                            $objReservationDAO->creer($objReservation);

                            echo "réservation réussi";
                        } else {
                            echo "deja réservé";
                        }
                    }
                }
                header('Location: ./index.php?controleur=accueil');
            } else {
                header('Location: ./index.php?controleur=gererConnexion&action=formIdentification');
            }
            break;

        case 'annulation':
            if (!isset($_SESSION['Utilisateur']) || !isset($_GET['id_trajet'])) header("Location: index.php");

            if ($objReservationDAO->supprimer($_GET['id_trajet'], $_SESSION['Utilisateur'])) echo "lol";

            header("Location: index.php");
    }
?>