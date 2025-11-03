<?php
define('ROOT_PATH', __DIR__ . '/..');

$host = 'localhost';
$dbname = 'tomtroc';
$user = 'root';
$pass = '';

try {
    $dbConnection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

