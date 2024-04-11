<header>
    <img src="res/images/logo_fr_uppa.png" alt="Logo de la République Française et de l'UPPA"/>
   
    <nav>
        <ul>
            <?php 
                if (!isset($_SESSION['Utilisateur'])) {
            ?>
            <li><a href="./index.php?controleur=gererConnexion&action=formIdentification" class="btn2">Connexion</a></li>
            <li><a href="./index.php?controleur=gererConnexion&action=formEnregistrement" class="btn">Créer un compte</a></li>
            <?php 
                } else {
                    if ($_SESSION['Utilisateur']->getType() == 1) {
            ?>
            <li><a href="./index.php?controleur=admin&action=dashboard" class="btn2">Mode administrateur</a></li>
            <?php
                    }
            ?>
            <li><a href="./index.php?controleur=gererConnexion&action=deconnexion" class="btn">Déconnexion</a></li>
            <?php
                }
            ?>
        </ul>
    </nav>
</header>