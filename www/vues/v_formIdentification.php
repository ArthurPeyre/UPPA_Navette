<form action="./index.php?controleur=gererConnexion&action=identification" method="post" style="padding-top: calc(83.2px + 15px); margin: 0 auto;">
    <h2>Se connecter</h2>

    <label for="txtemail">
        Email<br/>
        <input type="email" name="txtemail" id="" required>
    </label>

    <label for="txtmdp">
        Mot de passe<br/>
        <input type="password" name="txtmdp" id="" required>
    </label>

    <input type="submit" name="formConn" value="Se connecter">

    <span>Vous n'avez pas encore de compte ? <a href="./index.php?controleur=gererConnexion&action=formEnregistrement">Créer un compte ici</a></span>
</form>