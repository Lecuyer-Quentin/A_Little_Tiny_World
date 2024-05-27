<?php
$host = 'localhost';
$db   = 'A_Little_Tiny_World';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

function connect($dsn, $user, $pass, $options) {
    global $db, $pdo;
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

function create_database($pdo, $db) {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");
}

try {
    $pdo = connect($dsn, $user, $pass, $options); // Connexion à MySQL
    create_database($pdo, $db); // Créer la base de données
    $pdo = null; // Fermer la connexion
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; // Nouveau DSN avec la base de données
    $pdo = connect($dsn, $user, $pass, $options); // Connexion à la base de données
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}


