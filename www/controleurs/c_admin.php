<?php
    $action = $_REQUEST['action'];

    switch ($action) {
        case 'dashboard':
            if (!isset($_SESSION['Utilisateur']) || $_SESSION['Utilisateur']->getType() < 1) header('Location: ./index.php');
            header('Location: ./admin/general.php');
            break;

    }
?>