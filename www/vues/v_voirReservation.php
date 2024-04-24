<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stat.css">
    <title>NavConnect</title>
    </style>
</head>
<body>

<div id="app">
        <section id="dashboard">
            <h1>Tableau de bord</h1>
            <ul>
                <li><a href="./index.php?controleur=admin&action=dashboard" >Général</a></li>
                <li><a href="./index.php?controleur=admin&action=formAjouterDate">Ajouter date</a></li>
                <li><a href="./index.php?controleur=admin&action=formSupprimerDate">Supprimer date</a></li>
            </ul>
        </section>

        <section id="list" style="padding-top:0;">
            <div class="list__container">
                <form method="post" action="" >
                    <h2>Réservations</h2>
                    <input type="submit"class="btn" value="Télécharger le fichier Excel">
                </form>

                <div>
                    <table>
                        <tr>
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