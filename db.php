<?php
$host = 'localhost:3307';
$db   = 'micromercado';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // resultados como array asociativo
    PDO::ATTR_EMULATE_PREPARES   => false,                  // usa sentencias preparadas reales
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    //echo "Conexión exitosa.";
} catch (PDOException $e) {
    //echo "Error de conexión: " . $e->getMessage();
}
?>