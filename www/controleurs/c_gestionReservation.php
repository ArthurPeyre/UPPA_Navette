<?php
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'reserver':
            if (isset($_SESSION['Utilisateur'])) {
                if (isset($_POST['formReserver'])) {
                    $direction = ($_POST['depart'] < $_POST['arrivee']) ? 1 : 2;
    
                    $objTrajetDAO = new TrajetDAO();
                    $objReservationDAO = new ReservationDAO();
    
                    $objTrajet = $objTrajetDAO->getLeTrajet($_POST['lstDate'], $_POST['lstHoraire'], $direction);
    
                    // Si aucun tuple n'est renvoyé
                    if (!$objTrajet) {
    
                        $objTrajet = new Trajet(null, $_POST['lstDate'], $_POST['lstHoraire'], $direction);

                        echo "ok 2.a ";
    
                        if ($objTrajetDAO->creer($objTrajet)) {
    
                            $objTrajet = $objTrajetDAO->getLeTrajet($_POST['lstDate'], $_POST['lstHoraire'], $direction);
                            
                            $objReservation = new Reservation($objTrajet->getIdTrajet(), $_SESSION['Utilisateur']->getIdUtilisateur(), $_POST['depart'], $_POST['arrivee']);
                            $objReservationDAO->creer($objReservation);

                            echo "ok 3.a";
                        } else {
                            echo "ok 3.b";
                        }
                    } else {
                        echo "ok 2.b ";
                        if (!$objReservationDAO->estReservee($objTrajet, $_SESSION['Utilisateur'])) {

                            $objReservation = new Reservation($objTrajet->getIdTrajet(), $_SESSION['Utilisateur']->getIdUtilisateur(), $_POST['depart'], $_POST['arrivee']);
                            $objReservationDAO->creer($objReservation);

                            echo "ok 3.c";
                        } else {
                            echo "ok 3.d";
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

            $objReservationDAO = new ReservationDAO();
            if ($objReservationDAO->supprimer($_GET['id_trajet'], $_SESSION['Utilisateur'])) echo "lol";

            header("Location: index.php");
    }
?>