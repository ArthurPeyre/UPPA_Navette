<form action="./index.php?controleur=gererReservations&action=reserver" method="post" id="formReserver">
    <h2>Réserver</h2>

    <?php
    $objLieuxDAO = new LieuDAO();
    $tabLieux = $objLieuxDAO->getTousLesLieux();
    ?>

    <div>
        <label for="depart">
            Lieu de départ<br/>
        </label>
        <select name="depart" id="depart" required>
            <?php foreach ($tabLieux as $lieu) : ?>
                <option value="<?= $lieu->getIdLieu() ?>">
                    <span><?= $lieu->getVille() ?></span>
                    <span><?= $lieu->getLieu() ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="arrivee">
            Lieu d'arrivée<br/>
        </label>
        <select name="arrivee" id="arrivee" required>
            <?php foreach ($tabLieux as $lieu) :
                if ($lieu->getVille() === "Anglet") {
            ?>
                <option value="<?= $lieu->getIdLieu() ?>" selected>
            <?php
                } else {
            ?>
                <option value="<?= $lieu->getIdLieu() ?>">
            <?php
                }
            ?>
                    <span><?= $lieu->getVille() ?></span>
                    <span><?= $lieu->getLieu() ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php
    $objDateDAO = new DateDAO();
  
    $tabDates = $objDateDAO->getLesProchainesDates();

    ?>

    <div>
        <label for="">
            Date<br/>
        </label>
        <select name="lstDate" id="" required>
            <?php foreach ($tabDates as $date) :
                $timestamp = strtotime($date->getDate());
    
                $date_formatee = date("d M Y", $timestamp);
            ?>
                <option value="<?= $date->getIdDate() ?>">
                    <span><?= $date_formatee ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php
    $objHoraireDAO = new HoraireDAO();
    $tabHoraires = $objHoraireDAO->getLesHorairesDepart();
    ?>

    <div>
        <label for="">
            Heure de départ<br/>
        </label>
        <select name="lstHoraire" id="" required>
        <?php foreach ($tabHoraires as $horaire) : ?>
            <option value="<?= $horaire->getIdHoraire() ?>">
                <span><?= $horaire->getHeureDepart() ?></sid_lieupan>
            </option>
        <?php endforeach; ?>
        </select>
    </div>
    
    <input type="submit" name="formReserver" value="Réserver" class="btn">
    <div>Rappel : les horaires sont mentionnées pour un départ depuis Pau ou Anglet</div>
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