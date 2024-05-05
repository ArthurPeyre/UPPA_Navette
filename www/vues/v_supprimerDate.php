<form action="./index.php?controleur=admin&action=suppressionDate" method="post" id="formSupprimer">

    <h2>Supprimer Date</h2>

    <?php
    $objDateDAO = new DateDAO();
  
    $tabDates = $objDateDAO->getLesProchainesDates();

    ?>

    <div>
        <label for="lstDate">Date</label>
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
    </div>

    

    <input type="submit" name="formSupprimer" value="Supprimer la date" class="btn">

   
</form>