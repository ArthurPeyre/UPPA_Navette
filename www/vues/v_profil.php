<form action="" method="post" id="formProfil">
    <h2>Profil</h2>

    <?php
    if (!isset($_SESSION['Utilisateur'])) {
    ?>
    <p>Connectez-vous pour voir vos informations personnelles</p>
    <a href="index.php?controleur=gererConnexion&action=formIdentification" class="btn2">Connexion</a>
    <a href="index.php?controleur=gererConnexion&action=formEnregistrement" class="btn">Créer un compte</a>
    <?php
    } else {
    ?>

    <label for="txtnom">
        Nom<br/>
        <input type="text" name="txtnom" id="txtnom" value="<?= $_SESSION['Utilisateur']->getNom() ?>" required>
    </label>

    <label for="txtprenom">
        Prénom<br/>
        <input type="text" name="txtprenom" id="txtprenom" value="<?= $_SESSION['Utilisateur']->getPrenom() ?>" required>
    </label>

    <label for="txtemail">
        Email<br/>
        <input type="email" name="txtemail" id="txtemail" value="<?= $_SESSION['Utilisateur']->getEmail() ?>" required>
    </label>

    <label for="phone">
        Téléphone<br/>
        <input type="tel" name="phone" id="phone" value="<?= $_SESSION['Utilisateur']->getPhone() ?>" required>
    </label>

    <label for="residence">
        Résidence administrative<br/>
        <input type="tel" name="residence" id="residence" value="<?= $_SESSION['Utilisateur']->getResidenceAdministrative() ?>" required>
    </label>

    <input type="submit" name="formProfil" value="Enregistrer">
    <input type="reset" value="Annuler">
    <?php
    }
    ?>
</form>