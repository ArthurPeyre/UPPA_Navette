<?php
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'dashboard':
            
            if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
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

    $objTrajetDAO = new TrajetDAO();
    $objDateDAO = new DateDAO();
    $objHoraireDAO = new HoraireDAO();


    // Nombre de VISITES
    $stmt = $conn->prepare("SELECT COUNT(*) as visites FROM utilisateurs WHERE derniereConnexion>=:date");
    $date = date('Y-m-01');
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $Visites = $stmt->fetch();


    // Nombre d'UTILISATEURS
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT reserver.id_utilisateur) AS users FROM reserver INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet INNER JOIN date ON trajets.id_date = date.id_date WHERE date.id_date >= :date");
    $date = date('Y-m-01');
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $Utilisateurs = $stmt->fetch();


    // Nombre de RÉSERVATIONS
    $stmt = $conn->prepare("SELECT COUNT(*) as reservations FROM reserver INNER JOIN trajets ON trajets.id_trajet=reserver.id_trajet INNER JOIN date ON date.id_date = trajets.id_date WHERE date.date>=:date");
    $date = date('Y-m-01');
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $Reservations = $stmt->fetch();


    // Récurrence
    $stmt = $conn->prepare("SELECT AVG(reservations) AS recurrence
                            FROM (
                                SELECT COUNT(*) as reservations
                                FROM reserver 
                                INNER JOIN trajets ON reserver.id_trajet = trajets.id_trajet 
                                INNER JOIN date ON trajets.id_date = date.id_date 
                                WHERE date.id_date >= :date
                                GROUP BY reserver.id_utilisateur
                            ) AS sous_requete;");
    $date = date('Y-m-01');
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    $tmp = $stmt->fetch();
    $Recurrence = number_format($tmp['recurrence'], 2);


    // Liste des TRAJETS
    $lstTrajets = $objTrajetDAO->getLesProchainsTrajets();
            include_once('./vues/v_statAdmin.php');
            break;

            case 'formajouter' :
                if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
                include_once('./vues/v_ajouterDate.php');
                break;

            case 'ajouter' :
                if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');{
                $date = $_POST["txtDate"];
                $uneDate = new Date($date);
                $dateDao = new DateDAO();
$res = $dateDao->creer($uneDate);
                if($res){
                    echo "Date ajoutée avec succes";
                    
                }else{
                    echo "Erreur d'insertion";
                }
            }
                
                break;

          

                break;

            case 'formsupprimer' : 
                if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
                include_once('./vues/v_supprimerDate.php');
                break;
                

            case 'supprimer' :
                if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
                $idDate = $_POST["lstDate"];  
                $objDateDAO = new DateDAO();
                $resultat = $objDateDAO->supprimer($idDate);
                if ($resultat) {
                    header('Location: ./index.php?controleur=accueil');
                } else {
                    include_once('./vues/v_supprimerDate.php');
                }
                break;
        }

?>