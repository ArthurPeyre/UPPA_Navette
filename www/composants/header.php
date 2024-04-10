<header>
    <img src="res/images/logo_fr_uppa.png" alt="Logo de la République Française et de l'UPPA"/>
   
    <nav>
        <ul>
            <?php if (!isset($_SESSION['id_utilisateur'])) { ?>
            <li><a href="login.php" class="btn2">Connexion</a></li>
            <li><a href="register.php" class="btn">Créer un compte</a></li>
            <?php } else { ?>
            <li><a href="logout.php" class="btn">Déconnexion</a></li>
            <?php }?>
        </ul>
    </nav>
</header>