<?php
$servername = "localhost";  // або ваша IP-адреса
$username = "root";
$password = "1234";  // ваш пароль для бази даних
$dbname = "mobile_store";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Підключення не вдалося: " . $e->getMessage());
}
?>
