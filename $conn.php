<link rel="stylesheet" href="style.css">
<?php
$host = 'localhost';
$dbname = 'controle_financeiro';
$username = 'root';
$password = '';

try {
    $conexao_bd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexao_bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
