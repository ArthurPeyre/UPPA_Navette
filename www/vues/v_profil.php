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

    <div>
        <label for="txtnom">
            Nom
        </label>
        <input type="text" name="txtnom" id="txtnom" value="<?= $_SESSION['Utilisateur']->getNom() ?>" required>
    </div>

    <div>
        <label for="txtprenom">
            Prénom
        </label>
        <input type="text" name="txtprenom" id="txtprenom" value="<?= $_SESSION['Utilisateur']->getPrenom() ?>" required>
    </div>

    <div>
        <label for="txtemail">
            Email
        </label>
        <input type="email" name="txtemail" id="txtemail" value="<?= $_SESSION['Utilisateur']->getEmail() ?>" required>
    </div>

    <div>
        <label for="phone">
            Téléphone
        </label>
        <input type="tel" name="phone" id="phone" value="<?= $_SESSION['Utilisateur']->getPhone() ?>" required>
    </div>

    <div>
        <label for="residence">
            Résidence administrative
        </label>
        <input type="tel" name="residence" id="residence" value="<?= $_SESSION['Utilisateur']->getResidenceAdministrative() ?>" required>
    </div>

    <input type="submit" name="formProfil" value="Enregistrer" class="btn">
    
    <a href="./index.php?controleur=gererConnexion&action=deconnexion" class="deconnexion">Déconnexion</a>
    <?php
    }
    ?>
</form>