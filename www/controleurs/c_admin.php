<?php
$action = $_REQUEST['action'];

switch ($action) {
    case 'dashboard':

        if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
        // Définir le fuseau horaire
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

        // Traduction des mois en français
        $mois = array(
            'January' => 'Janvier',
            'February' => 'Février',
            'March' => 'Mars',
            'April' => 'Avril',
            'May' => 'Mai',
            'June' => 'Juin',
            'July' => 'Juillet',
            'August' => 'Août',
            'September' => 'Septembre',
            'October' => 'Octobre',
            'November' => 'Novembre',
            'December' => 'Décembre'
        );

        $objTrajetDAO = new TrajetDAO();
        $objDateDAO = new DateDAO();
        $objHoraireDAO = new HoraireDAO();
        $objUtilisateurDAO = new UtilisateurDAO();
        $objReservationDAO = new ReservationDAO();
        // Nombre de VISITES
        $Visites = $objUtilisateurDAO->getNbVisites();

        // Nombre d'UTILISATEURS
        $Utilisateurs = $objReservationDAO->getNbUtilisateurs();

        // Nombre de RÉSERVATIONS
        $Reservations = $objReservationDAO->getNbReservations();

        // Récurrence
        $Recurrence = $objReservationDAO->getRecurrence();

        // Liste des TRAJETS
        $lstTrajets = $objTrajetDAO->getLesProchainsTrajets();
        include_once('./vues/v_statAdmin.php');
        include_once('./vues/v_trajetAdmin.php');
        break;

    case 'formAjouterDate':
        if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
        include_once('./vues/v_ajouterDate.php');
        break;

    case 'ajouterDate':
        $date = $_POST["txtDate"];
        $today = date("Y-m-d"); 
        $inputDate = date("Y-m-d", strtotime($date));
        $idDate=NULL;
        if ($inputDate >= $today) {
            $uneDate = new Date($idDate,$date);
            $dateDao = new DateDAO();
            $res = $dateDao->creer($uneDate);
            if ($res) {
                $message =  "Date ajoutée avec succès.";
            } else {
                
                $message =  "Erreur d'insertion.";
            }
        } else {
            
            $message =  "La date choisit est inférieur à la date du jour";
        }
        include_once('./vues/v_ajouterDate.php');
        echo $message;
        break;


    case 'formSupprimerDate':
        if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
        include_once('./vues/v_supprimerDate.php');
        break;


    case 'suppressionDate':
        if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
        $idDate = $_POST["lstDate"];
        $objDateDAO = new DateDAO();
        $resultat = $objDateDAO->supprimer($idDate);
        if ($resultat) {
            $message= "Date supprimer avec succès ";
        } else {
            $message =  "Erreur dans la suppression";
        }
        include_once('./vues/v_supprimerDate.php');
        echo $message;
        break;
    
    case 'voirReservation':
        if (!isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur']->getType() < 1) {
        header('Location: ../index.php');
    }

    // Définir le fuseau horaire
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');

    // Traduction des mois en français
    $mois = array(
        'January' => 'Janvier',
        'February' => 'Février',
        'March' => 'Mars',
        'April' => 'Avril',
        'May' => 'Mai',
        'June' => 'Juin',
        'July' => 'Juillet',
        'August' => 'Août',
        'September' => 'Septembre',
        'October' => 'Octobre',
        'November' => 'Novembre',
        'December' => 'Décembre'
    );
        // Liste des TRAJETS
    $stmt = $conn->prepare("SELECT utilisateurs.nom, utilisateurs.prenom, utilisateurs.email, utilisateurs.phone, CONCAT(depart.ville, ', ', depart.lieu) AS lieuDepart, CONCAT(arrivee.ville, ', ', arrivee.lieu) AS lieuArrivee
    FROM utilisateurs 
    INNER JOIN reserver ON utilisateurs.id_utilisateur = reserver.id_utilisateur
    INNER JOIN lieux AS depart ON reserver.id_lieuDepart = depart.id_lieu
    INNER JOIN lieux AS arrivee ON reserver.id_lieuArrivee = arrivee.id_lieu
    WHERE reserver.id_trajet = :trajet
    ORDER BY reserver.id_lieuDepart, reserver.id_lieuArrivee");
    $date = date('Y-m-01');
    $stmt->bindParam(':trajet', $_POST['idTrajet']);
    $stmt->execute();
    $lstUsers = $stmt->fetch();

        include_once('./vues/v_voirReservation.php');
}

