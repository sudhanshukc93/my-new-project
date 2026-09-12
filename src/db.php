<?php

$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'taskflow';
$user = getenv('DB_USER') ?: 'taskflow';
$pass = getenv('DB_PASSWORD') ?: 'taskflow123';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
