<?php
$host = 'localhost';
$db = 'gp_to_gp';
$user = 'root';
$pass = 'root'; // remplace par ton vrai mot de passe

try {
    $pdo = new PDO("mysql:host=localhost;dbname=gp_to_gp", "root", "root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
