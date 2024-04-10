<?php
include_once('conn.php');

$conn = conn();

session_start();

if (isset($_SESSION['id_utilisateur'])) header("Location: index.php");

$err = null;

if (isset($_POST['formConn'])) {
    // Requête préparée pour la sélection
    $stmt = $conn->prepare("SELECT id_utilisateur, type FROM utilisateurs WHERE email=:email OR phone=:phone");

    // Liage des valeurs
    $stmt->bindParam(':email', $_POST['txtemail']);
    $stmt->bindParam(':phone', $_POST['phone']);

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $id_user = $stmt->fetch();

    // Si aucun tuple n'est renvoyé
    if (!$id_user) {

        // Requête préparée pour l'insertion
        $stmt = $conn->prepare("INSERT INTO utilisateurs VALUES (NULL, :nom, :prenom, :email, :phone, :mdp, '', '', NOW())");

        // Liage des valeurs
        $stmt->bindParam(':nom', $_POST['txtnom']);
        $stmt->bindParam(':prenom', $_POST['txtprenom']);
        $stmt->bindParam(':email', $_POST['txtemail']);
        $stmt->bindParam(':phone', $_POST['phone']);

        $password = $_POST['txtmdp']; // Le mot de passe à crypter

        // Hasher le mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt->bindParam(':mdp', $hash);

        // Si l'insertion a réussi
        if ($stmt->execute()) {
            // Requête préparée pour la sélection
            $stmt = $conn->prepare("SELECT id_utilisateur, type FROM utilisateurs WHERE email=:email AND password=:mdp");
            
            // Liage des valeurs
            $stmt->bindParam(':email', $_POST['txtemail']);
            $stmt->bindParam(':mdp', $hash);
            
            // Exécution de la requête
            $stmt->execute();

            // Récupération des résultats
            $id_user = $stmt->fetch();
            
            $_SESSION['id_utilisateur'] = $id_user['id_utilisateur'];
            
            header('Location: index.php');
        } else {
            $err = "L'insertion a échouée...";
        }

    } else {
        $err = "Cette adresse mail et/ou ce numéro de téléphone sont déjà utilisés...";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPPA | Navette - Créer un compte</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    include_once('./composants/header.php');
    ?>

    <form action="" method="post" style="padding-top: calc(83.2px + 15px); margin: 0 auto;">
        <h2>Créer un compte</h2>

        <p><?= $err ?></p>

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

    <?php
    close($conn);
    ?>
    
</body>
</html>