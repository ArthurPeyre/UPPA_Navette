<form method="post" class="list__container" action="./index.php?controleur=admin&action=fichierExcel" >
    <h2>Réservations</h2>
    <input type="submit"class="btn" value="Télécharger le fichier Excel">

    <table>
        <tr>
            <th style="text-align: left;">Nom Prénom</th>
            <th style="text-align: left;">Email</th>
            <th style="text-align: left;">Téléphone</th>
            <th style="text-align: left;">Lieu Départ</th>
            <th style="text-align: left;">Lieu Arrivée</th>
        </tr>
        <?php
            foreach($tabPersonne as $lstUsers) {
                ?>
        <tr>
            <td style="text-align: left;"><?= $lstUsers['nom'] ?> <?= $lstUsers['prenom'] ?></td>
            <td style="text-align: left;"><?= $lstUsers['email'] ?></td>
            <td style="text-align: left;"><?= $lstUsers['phone'] ?></td>
            <td style="text-align: left;"><?= $lstUsers['lieuDepart'] ?></td>
            <td style="text-align: left;"><?= $lstUsers['lieuArrivee'] ?></td>
        </tr>
        <?php } ?>
    </table>
</form>