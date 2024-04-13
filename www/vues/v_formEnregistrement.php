<form action="./index.php?controleur=gererConnexion&action=enregistrement" method="post" id="formProfil">
    <h2>Créer un compte</h2>

    <label for="txtnom">
        Nom<br/>
        <input type="text" name="txtnom" id="txtnom" required>
    </label>

    <label for="txtprenom">
        Prénom<br/>
        <input type="text" name="txtprenom" id="txtprenom" required>
    </label>

    <label for="txtemail">
        Email<br/>
        <input type="email" name="txtemail" id="txtemail" required>
    </label>

    <label for="phone">
        Téléphone<br/>
        <input type="tel" name="phone" id="phone" required>
    </label>

    <label for="txtmdp">
        Mot de passe<br/>
        <input type="password" name="txtmdp" id="txtmdp" required>
    </label>

    <label for="residence">
        Résidence administrative<br/>
        <input type="text" name="residence" id="residence" required>
    </label>

    <input type="submit" name="formConn" value="Créer un compte">

    <span>Vous avez déjà un compte ? <a href="./index.php?controleur=gererConnexion&action=formIdentification">Connectez-vous</a></span>
</form>