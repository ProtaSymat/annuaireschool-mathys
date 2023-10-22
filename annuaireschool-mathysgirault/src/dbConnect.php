<?php
$databaseConfigJson = file_get_contents(__DIR__ . '/database.json');
$databaseConfig = json_decode($databaseConfigJson, true);

try {
    $connection = new PDO(
        'mysql:host=' . $databaseConfig['host'] . ';port=' . $databaseConfig['port'] . ';dbname=' . $databaseConfig['db_name'],$databaseConfig['user'],$databaseConfig['password']
    );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
