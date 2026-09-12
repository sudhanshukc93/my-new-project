<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'devops_app';
$user = getenv('DB_USER') ?: 'devops_user';
$pass = getenv('DB_PASSWORD') ?: 'devops_password';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
