<?php
$err = null;

if (isset($_POST['formReserver'])) {

    if (!isset($_SESSION['id_utilisateur'])) header("Location: login.php");
    
    $direction = ($_POST['depart'] < $_POST['arrivee']) ? 1 : 2;

    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT id_trajet FROM trajets WHERE id_date=:date AND id_horaire=:horaire AND id_direction=:direction");

    // Liage des valeurs
    $stmt->bindParam(':date', $_POST['lstDate']);
    $stmt->bindParam(':horaire', $_POST['lstHoraire']);
    $stmt->bindParam(':direction', $direction);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $id_trajet = $stmt->fetch();

    // Si aucun tuple n'est renvoyé
    if (!$id_trajet) {

        // Requête préparée pour l'insertion
        $stmt = $conn->prepare("INSERT INTO trajets VALUES (NULL, :date, :horaire, :direction)");
        // Liage des valeurs
        $stmt->bindParam(':date', $_POST['lstDate']);
        $stmt->bindParam(':horaire', $_POST['lstHoraire']);
        $stmt->bindParam(':direction', $direction);
        $stmt->execute();

        // Requête préparée pour la sélection
        $stmt = $conn->prepare("SELECT id_trajet FROM trajets WHERE id_date=:date AND id_horaire=:horaire AND id_direction=:direction");
        // Liage des valeurs
        $stmt->bindParam(':date', $_POST['lstDate']);
        $stmt->bindParam(':horaire', $_POST['lstHoraire']);
        $stmt->bindParam(':direction', $direction);
        $stmt->execute();
        $id_trajet = $stmt->fetch();
        
        // Requête préparée pour l'insertion
        $stmt = $conn->prepare("INSERT INTO reserver VALUES (:trajet, :user, :depart, :arrivee)");
    
        $stmt->bindParam(':trajet', $id_trajet['id_trajet']);
        $stmt->bindParam(':user', $_SESSION['id_utilisateur']);
        $stmt->bindParam(':depart', $_POST['depart']);
        $stmt->bindParam(':arrivee',  $_POST['arrivee']);
    
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("SELECT * FROM reserver WHERE id_trajet=:trajet AND id_utilisateur=:user");

        $stmt->bindParam(':trajet', $id_trajet['id_trajet']);
        $stmt->bindParam(':user', $_SESSION['id_utilisateur']);

        $stmt->execute();

        // Compter le nombre de résultats trouvés
        $num_rows = $stmt->rowCount();

        if ($num_rows == 0) {
            // Requête préparée pour l'insertion
            $stmt = $conn->prepare("INSERT INTO reserver VALUES (:trajet, :user, :depart, :arrivee)");
        
            $stmt->bindParam(':trajet', $id_trajet['id_trajet']);
            $stmt->bindParam(':user', $_SESSION['id_utilisateur']);
            $stmt->bindParam(':depart', $_POST['depart']);
            $stmt->bindParam(':arrivee',  $_POST['arrivee']);
        
            $stmt->execute();
        } else {
            $err = "Vous avez déjà réservé ce trajet...";
        }
    }
}
?>

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