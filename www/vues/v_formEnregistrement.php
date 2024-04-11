<form action="" method="post" style="padding-top: calc(83.2px + 15px); margin: 0 auto;">
    <h2>Créer un compte</h2>

    <label for="txtnom">
        Nom<br/>
        <input type="text" name="txtnom" id="" required>
    </label>

    <label for="txtprenom">
        Prénom<br/>
        <input type="text" name="txtprenom" id="" required>
    </label>

    <label for="txtemail">
        Email<br/>
        <input type="email" name="txtemail" id="" required>
    </label>

    <label for="phone">
        Téléphone<br/>
        <input type="tel" name="phone" id="" required>
    </label>

    <label for="txtmdp">
        Mot de passe<br/>
        <input type="password" name="txtmdp" id="" required>
    </label>

    <input type="submit" name="formConn" value="Créer un compte">

    <span>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></span>
</form>