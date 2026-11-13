<?php
$dsn = "mysql:host=localhost;dbname=CAT2;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, "cat2user", "Cat2Pass123!", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
session_start();
