<?php
include_once('../conn.php');
session_start();
$conn = conn();
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
$stmt->bindParam(':trajet', $_SESSION['idTrajet']);
$stmt->execute();
$lstUsers = $stmt->fetch();

header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=infoTrajet".$_SESSION['idTrajet'].".xls");
echo '<table>'.chr(13);
echo '    <tr>'.chr(13);
echo '        <td>Nom Prénom</td>'.chr(13);
echo '        <td>Email</td>'.chr(13);
echo '        <td>Téléphone</td>'.chr(13);
echo '        <td>Lieu Départ</td>'.chr(13);
echo '        <td>Lieu Arrivée</td>'.chr(13);
echo '    </tr>'.chr(13);
while ($lstUsers != NULL) {
    echo '    <tr>'.chr(13);
    echo '        <td>'.$lstUsers['nom'].' '.$lstUsers['prenom'].'</td>'.chr(13);
    echo '        <td>'.$lstUsers['email'].'</td>'.chr(13);
    echo '        <td>'.$lstUsers['phone'].'</td>'.chr(13);
    echo '        <td>'.$lstUsers['lieuDepart'].'</td>'.chr(13);
    echo '        <td>'.$lstUsers['lieuArrivee'].'</td>'.chr(13);
    echo '    </tr>'.chr(13);
    $lstUsers = $stmt->fetch();
}
echo '</table>'.chr(13);
?>