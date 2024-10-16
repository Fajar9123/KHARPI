<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portalberita');

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die('Maaf koneksi gagal: ' . $mysqli->connect_error);
}

// Set charset to utf8mb4 for better compatibility
$mysqli->set_charset('utf8mb4');
?>
