<?php
include_once('conn.php');

$conn = conn();

session_start();

if (isset($_SESSION['id_utilisateur'])) header("Location: index.php");

$err = null;

if (isset($_POST['formConn'])) {
    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT id_utilisateur, password, `type` FROM utilisateurs WHERE email=:email");

    // Liage des valeurs
    $stmt->bindParam(':email', $_POST['txtemail']);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $id_user = $stmt->fetch();

    // Si aucun tuple n'est renvoyé
    if (!$id_user) {
        $err = "Adresse mail inconnue...";
    } else {

        // Vérifier si le mot de passe correspond au hash
        if (password_verify($_POST['txtmdp'], $id_user['password'])) {
            $_SESSION['id_utilisateur'] = $id_user['id_utilisateur'];

            if ($id_user['type'] == 1) {
                $_SESSION['type'] = 1;
            }
            
            // Requête préparée pour l'insertion
            $stmt = $conn->prepare("UPDATE utilisateurs SET derniereConnexion=NOW() WHERE id_utilisateur=:id");
            // Liage des valeurs
            $stmt->bindParam(':id', $_SESSION['id_utilisateur']);
            $stmt->execute();

            header('Location: index.php');
        } else {
            $err = "Mot de passe incorrect...";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPA | Navette - Se connecter</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    include_once('./composants/header.php');
    ?>

    <form action="" method="post" style="padding-top: calc(83.2px + 15px); margin: 0 auto;">
        <h2>Se connecter</h2>

        <p><?= $err ?></p>

        <label for="txtemail">
            Email<br/>
            <input type="email" name="txtemail" id="" required>
        </label>

        <label for="txtmdp">
            Mot de passe<br/>
            <input type="password" name="txtmdp" id="" required>
        </label>

        <input type="submit" name="formConn" value="Se connecter">

        <span>Vous n'avez pas encore de compte ? <a href="register.php">Créer un compte ici</a></span>
    </form>

    <?php
    close($conn);
    ?>
    
</body>
</html>