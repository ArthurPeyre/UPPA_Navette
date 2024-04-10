<form action="" method="post" id="formReserver">
    <h2>Réserver</h2>

    <?php
    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT * FROM lieux WHERE 1");

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $resultats = $stmt->fetchAll();
    ?>

    <label for="depart">
        Lieu de départ<br/>
        <select name="depart" id="depart" required>
            <?php foreach ($resultats as $lieu) : ?>
                <option value="<?= $lieu['id_lieu'] ?>">
                    <span><?= $lieu['ville'] ?></span>
                    <span><?= $lieu['lieu'] ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label for="arrivee">
        Lieu d'arrivée<br/>
        <select name="arrivee" id="arrivee" required>
            <?php foreach ($resultats as $lieu) :
                if ($lieu['ville'] === "Anglet") {
            ?>
                <option value="<?= $lieu['id_lieu'] ?>" selected>
            <?php
                } else {
            ?>
                <option value="<?= $lieu['id_lieu'] ?>">
            <?php
                }
            ?>
                    <span><?= $lieu['ville'] ?></span>
                    <span><?= $lieu['lieu'] ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <?php
    // Définit le fuseau horaire à utiliser
    date_default_timezone_set('Europe/Paris');

    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT * FROM date WHERE date >= :date ORDER BY date");

    // Récupère la date du jour dans le format "aaaa-mm-jj"
    $date_du_jour = date("Y-m-d");

    $stmt->bindParam(':date', $date_du_jour);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $resultats = $stmt->fetchAll();
    ?>

    <label for="">
        Date<br/>
        <select name="lstDate" id="" required>
            <?php foreach ($resultats as $date) :
                // Convertit la date en format timestamp
                $timestamp = strtotime($date['date']);

                // Formate la date en "jj mois abrégé aaaa"
                $date_formatee = date("d M Y", $timestamp);
            ?>
                <option value="<?= $date['id_date'] ?>">
                    <span><?= $date_formatee ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <?php
    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT * FROM horaire WHERE 1");

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $resultats = $stmt->fetchAll();
    ?>

<label for="">
    Heure de départ<br/>
    <select name="lstHoraire" id="" required>
        <?php foreach ($resultats as $horaire) : ?>
            <option value="<?= $horaire['id_horaire'] ?>">
                <span><?= $horaire['heureDepart'] ?></sid_lieupan>
            </option>
            <?php endforeach; ?>
        </select>
    </label>
    
    <p class="error"><?= $err; ?></p>
    
    <input type="submit" name="formReserver" value="Réserver">
    <div>  Rappel : les horaires sont mentionnées pour un départ depuis Pau ou d'Anglet</div>
</form>


<script>
    // Récupère les éléments de sélection
    var depart = document.getElementById('depart');
    var arrivee = document.getElementById('arrivee');

    // Écoute les événements de changement
    depart.addEventListener('change', updateOptions);
    arrivee.addEventListener('change', updateOptions);

    function updateOptions() {
        // Récupère les valeurs sélectionnées
        var departValue = depart.value;
        var arriveeValue = arrivee.value;

        // Parcourt toutes les options
        for (var i = 0; i < depart.options.length; i++) {
            var departOption = depart.options[i];
            var arriveeOption = arrivee.options[i];

            // Active ou désactive les options en fonction de la valeur sélectionnée dans l'autre liste
            departOption.disabled = (departOption.value == arriveeValue);
            arriveeOption.disabled = (arriveeOption.value == departValue);
        }
    }

    // Appelle la fonction une fois pour initialiser les options
    updateOptions();
</script>