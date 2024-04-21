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
    $stmt->bindParam(':trajet', $_POST['idTrajet']);
    $stmt->execute();
    $lstUsers = $stmt->fetch();
    $_SESSION['idTrajet']=$_POST['idTrajet'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavConnect</title>

    <style>
        *,
        *::before,
        *::after {
            position: relative;
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            text-decoration: none;
            color: #000;
            list-style: none;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            outline: none;
            border: none;
        }

        body {
            min-height: 100dvh;
            font-size: 16px;
            background-color: rgba(0, 84, 255, 0.05);
        }

        #app {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-height: inherit;
        }
        
        #app > * {
            padding: 15px 30px;
        }

        #dashboard {
            display: grid;
            width: 100%;
            gap: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            background-color: #F2F6FF;
            z-index: 998;
        }

        a {
            font-weight: 600;
        }

        #list {
            min-height: fit-content;
            max-height: 100%;
        }

        .list__container {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            display: grid;
            gap: 15px;
            margin: 15px 0;
            height: 100%;
        }

        .list__container > div {
            max-height: 400px;
            overflow: auto;
        }

        .list__container div table {
            table-layout: fixed;
            width: 100%;
            min-width: 750px;
            overflow-x: auto;
            height: 100%;
            border-spacing: 0; /* Espacement entre les cellules */
        }

        .list__container table tr:hover, .list__container table tr.active {
            background-color: rgba(0, 84, 255, 0.15) !important;
        }
        .list__container table tr:first-child:hover {
            background-color: #fff !important;
        }

        .list__container table tr:nth-child(even) {
            background-color: rgba(0, 84, 255, 0.05);
        }
        .list__container table tr th {
            /* position: sticky;
            top: 40px; */
            color: rgba(0, 0, 0, 0.30);
        }
        .list__container table tr > * {
            padding: 15px max(15px, 2%);
            white-space: nowrap; /* Empêche le texte de se retourner à la ligne */
            overflow: hidden; /* Masque le contenu dépassant de la largeur du conteneur */
            text-overflow: ellipsis;
        }
        .list__container table tr > *:first-child {
            padding-left: 15px;
        }
        .list__container table tr > *:last-child {
            padding-right: 15px;
        }

        .btn {
            font-weight: 600;
            color: #fff;
            background: #0054FF;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div id="app">
        <section id="dashboard">
            <h1>Tableau de bord</h1>
            <ul style="display: flex; gap: 15px;">
                <li><a href="./general.php" style="color: #0054FF;">Général</a></li>
                <li><a href="">Opérations</a></li>
            </ul>
        </section>

        <section id="list" style="padding-top:0;">
            <div class="list__container">
                <form method="post" action="./excelcreation.php" style="display: flex; align-items; center; justify-content: space-between;">
                    <h2>Réservations</h2>
                    <input type="submit"class="btn" value="Télécharger le fichier Excel">
                </form>

                <div>
                    <table>
                        <tr style="position: sticky; top:0; background-color: #fff !important; z-index: 1;">
                            <th style="text-align: left;">Nom Prénom</th>
                            <th style="text-align: left;">Email</th>
                            <th style="text-align: left;">Téléphone</th>
                            <th style="text-align: left;">Lieu Départ</th>
                            <th style="text-align: left;">Lieu Arrivée</th>
                        </tr>
                        <?php
                            while ($lstUsers != NULL) {
                        ?>
                        <tr>
                            <td style="text-align: left;"><?= $lstUsers['nom'] ?> <?= $lstUsers['prenom'] ?></td>
                            <td style="text-align: left;"><?= $lstUsers['email'] ?></td>
                            <td style="text-align: left;"><?= $lstUsers['phone'] ?></td>
                            <td style="text-align: left;"><?= $lstUsers['lieuDepart'] ?></td>
                            <td style="text-align: left;"><?= $lstUsers['lieuArrivee'] ?></td>
                        </tr>
                        <?php
                                $lstUsers = $stmt->fetch();
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>
</html>