<form action="" method="post" id="formProfil">
    <h2>Profil</h2>

    <?php
    if (!isset($_SESSION['id_utilisateur'])) {
    ?>
    <p>Connectez-vous pour voir vos informations personnelles</p>
    <a href="login.php" class="btn2">Connexion</a>
    <a href="register.php" class="btn">Créer un compte</a>
    <?php
    } else {
        // Requête préparée pour la sélection
        $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=:user");
                
        // Liage des valeurs
        $stmt->bindParam(':user', $_SESSION['id_utilisateur']);
        
        // Exécution de la requête
        $stmt->execute();
    
        // Récupération des résultats
        $user = $stmt->fetch();
    ?>

    <label for="txtnom">
        Nom<br/>
        <input type="text" name="txtnom" id="txtnom" value="<?= $user['name'] ?>" required>
    </label>

    <label for="txtprenom">
        Prénom<br/>
        <input type="text" name="txtprenom" id="txtprenom" value="<?= $user['firstname'] ?>" required>
    </label>

    <label for="txtemail">
        Email<br/>
        <input type="email" name="txtemail" id="txtemail" value="<?= $user['email'] ?>" required>
    </label>

    <label for="phone">
        Téléphone<br/>
        <input type="tel" name="phone" id="phone" value="<?= $user['phone'] ?>" required>
    </label>

    <input type="submit" name="formProfil" value="Enregistrer">
    <input type="reset" value="Annuler">
    <?php
    }
    ?>
</form>