<section id="dashboard">
    <h1>Tableau de bord</h1>
    <ul style="display: flex; gap: 15px;">
        <li><a href="./index.php?controleur=admin&action=dashboard" >Général</a></li>
        <li><a href="./index.php?controleur=admin&action=formAjouterDate">Ajouter date</a></li>
        <li><a href="./index.php?controleur=admin&action=formSupprimerDate">Supprimer date</a></li>
    </ul>
</section>

<?php
$action = $_REQUEST['action'];

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

switch ($action) {
    case 'dashboard':

        if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
        
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
            $idDate = NULL;
            $uneDate = new Date($idDate,$date);
            $res = $objDateDAO->creer($uneDate);
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
        $_SESSION['idTrajet']=$_POST['idTrajet'];
        $tabPersonne = $objTrajetDAO->getTousLesUtilisateurs($_SESSION['idTrajet']);
        $_SESSION['tabPersonne']=$tabPersonne;

        include_once('./vues/v_voirReservation.php');
        break;

    case 'fichierExcel':
        if (!isset($_SESSION['Utilisateur']) && $_SESSION['Utilisateur']->getType() < 1) {
            header('Location: ../index.php');
        }
        $objTrajet = $objTrajetDAO->charger($_SESSION['idTrajet']);
        $direction = ($objTrajet->getIdDirection() == 1) ? "Anglet" : "Pau";
        $tabPersonne=$_SESSION['tabPersonne'];
        
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=infoTrajetdu".$objDateDAO->charger($objTrajet->getIdDate())->getDate()." a ".$objHoraireDAO->charger($objTrajet->getIdHoraire())->getHeureDepart().".xls");
        echo '<table>'.chr(13);
        echo '<caption>Trajet en direction de '.$direction.' a '.$objHoraireDAO->charger($objTrajet->getIdHoraire())->getHeureDepart().' le '.$objDateDAO->charger($objTrajet->getIdDate())->getDate().'<\caption>';
        echo '    <tr>'.chr(13);
        echo '        <td>Nom Prénom</td>'.chr(13);
        echo '        <td>Email</td>'.chr(13);
        echo '        <td>Téléphone</td>'.chr(13);
        echo '        <td>Lieu Départ</td>'.chr(13);
        echo '        <td>Lieu Arrivée</td>'.chr(13);
        echo '    </tr>'.chr(13);
        foreach($tabPersonne as $lstUsers) {
            echo '    <tr>'.chr(13);
            echo '        <td>'.$lstUsers['nom'].' '.$lstUsers['prenom'].'</td>'.chr(13);
            echo '        <td>'.$lstUsers['email'].'</td>'.chr(13);
            echo '        <td>'.$lstUsers['phone'].'</td>'.chr(13);
            echo '        <td>'.$lstUsers['lieuDepart'].'</td>'.chr(13);
            echo '        <td>'.$lstUsers['lieuArrivee'].'</td>'.chr(13);
            echo '    </tr>'.chr(13);
        }
        echo '</table>'.chr(13);
        break;
}
?>