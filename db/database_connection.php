<?php
$servername = "localhost";
$username = "mrfothbey";
$password = "GRM(aB/VYzK2IC9Z";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=fothbey", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
