<?php
class GestionConnexion {
    private static $instance = null;
    private static $conn;

    private function __construct() {
        self::$conn = new PDO('mysql:host=localhost;dbname=uppa_navette', 'root', 'root');
    }

    public static function getConnexion() {
        if (is_null(self::$instance)) self::$instance = new GestionConnexion();

        return (self::$conn);
    }

    // Libérer la connexion à la base de données
    public static function free() {
        self::$instance = null;
        self::$conn = null;
    }
}
?>