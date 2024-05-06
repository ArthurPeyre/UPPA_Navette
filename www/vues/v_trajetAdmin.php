<form class="list__container" action="./index.php?controleur=admin&action=voirReservation" method="post">
    
    <h2>Trajets</h2>

    <input type="submit" value="Voir les réservations" class="btn">

    <table>
        <tr style="position: sticky; top:0; background-color: #fff !important; z-index: 1;">
            <th style="padding: 15px !important; width: 43px;"></th>
            <!-- <th style="text-align: left;">Statu</th> -->
            <th style="text-align: left;">Date</th>
            <th style="text-align: left;">Horaire Départ</th>
            <th style="text-align: left;">Direction</th>
            <th style="text-align: right;">Nombre Passagers</th>
        </tr>
            <?php
                foreach ($lstTrajets as $trajet) {
                    // Date au format "yyyy-mm-dd"
                    $objDate = $objDateDAO->charger($trajet->getIdDate());
                    $date = $objDate->getDate();

                    // Transformer la date en format "j F Y" (1 Avril 2024)
                    $date_formattee = date("j ", strtotime($date)) . $mois[date('F', strtotime($date))] . date(" Y", strtotime($date));

                    $objHoraire = $objHoraireDAO->charger($trajet->getIdHoraire());

                    $direction = ($trajet->getIdDirection() == 1) ? "Anglet" : "Pau";
                    $nbPassagers = $objTrajetDAO->getNbReservations($trajet);

// Affichage uniquement des trajets avec des réservations
if ($nbPassagers > 0) {
?>
        
            <tr>
                <td style="padding: 15px !important; width: 43px;"><input type="radio" name="idTrajet" id="idTrajet" value="<?= $trajet->getIdTrajet() ?>" required></td>
                <!-- <td style="text-align: left;">Maintenu</td> -->
                <td style="text-align: left;"><?= $date_formattee ?></td>
                <td style="text-align: left;"><?= $objHoraire->getHeureDepart() ?></td>
                <td style="text-align: left;"><?= $direction ?></td>
                <td style="text-align: right;"><?= $objTrajetDAO->getNbReservations($trajet) ?></td>
            </tr>
                
            <?php
                }
            }
            ?>
    </table>
</form>

<script>
    // Récupérez tous les éléments input de type radio avec l'attribut name "idTrajet"
    const inputs = document.querySelectorAll('input[name="idTrajet"]');
    const resetButton = document.querySelector('input[type="reset"]');
    const span = document.getElementById('compteur');

    // Parcourez chaque input
    inputs.forEach(input => {
        // Ajoutez un écouteur d'événements "change"
        input.addEventListener('change', function() {
            // Supprimez la classe "active" de toutes les lignes du tableau
            const allRows = document.querySelectorAll('.list__container table tr');
            allRows.forEach(row => {
                row.classList.remove('active');
            });

            // Récupérez la ligne parente tr de l'input
            const parentRow = this.closest('tr');

            // Si l'input est coché, ajoutez la classe "active" à la ligne parente
            if (this.checked) {
                parentRow.classList.add('active');
                span.innerHTML = "1";
            }
        });
    });

    // Parcourez chaque ligne du tableau
    const tableRows = document.querySelectorAll('.list__container table tr');
    tableRows.forEach(row => {
        // Ajoutez un écouteur d'événements "click"
        row.addEventListener('click', function() {
            // Récupérez l'input correspondant dans la même ligne
            const input = this.querySelector('input[name="idTrajet"]');
            // Vérifiez si l'input existe et simulez un clic sur celui-ci
            if (input) {
                input.click();
            }
        });
    });

    // Ajoutez un écouteur d'événements "click" sur le bouton de reset
    resetButton.addEventListener('click', function() {
        // Désélectionnez tous les inputs
        inputs.forEach(input => {
            input.checked = false;
        });

        // Supprimez la classe "active" de toutes les lignes du tableau
        const allRows = document.querySelectorAll('.list__container table tr');
        allRows.forEach(row => {
            row.classList.remove('active');
            span.innerHTML = "0";
        });
    });
</script>