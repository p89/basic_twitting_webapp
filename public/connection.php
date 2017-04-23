<?php
require_once __DIR__ . '/../config/db.php';

$connection = new PDO(sprintf("mysql:host=%s;dbname=%s", $DB_HOST, $DB_NAME), $DB_USER, $DB_PASS);

if ($connection->errorCode() != null) {
    var_dump($connection->errorInfo());
    die();
}

echo "Nawiązano połączenie.<br>";


