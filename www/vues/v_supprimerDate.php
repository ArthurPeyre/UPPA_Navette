<form action="./index.php?controleur=admin&action=suppressionDate" method="post" id="formSupprimer">
<section id="dashboard">
            
            <ul style="display: flex; gap: 15px;">
                <li><a href="./index.php?controleur=admin&action=dashboard" >Général</a></li>
                <li><a href="./index.php?controleur=admin&action=formAjouterDate">Ajouter date</a></li>
                <li><a href="./index.php?controleur=admin&action=formSupprimerDate">Supprimer date</a></li>
            </ul>
        </section>
    <h2>Supprimer Date</h2>

    <?php
    $objDateDAO = new DateDAO();
  
    $tabDates = $objDateDAO->getLesProchainesDates();

    ?>

<label for="lstDate">Date<br/>
        <select name="lstDate" id="lstDate" required>
            <?php foreach ($tabDates as $date) :
                $timestamp = strtotime($date->getDate());

                $date_formatee = date("d M Y",$timestamp);
            ?>
                <option value="<?= $date->getIdDate() ?>">
                    <span><?= $date_formatee ?></span>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    

    <input type="submit" name="formSupprimer" value="Supprimer">

   
</form>