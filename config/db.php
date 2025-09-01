<?php
// Database connection using MySQLi
// Adjust credentials to your local setup
$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_NAME = getenv('DB_NAME') ?: 'projetoweb';
$DB_PORT = getenv('DB_PORT') ?: 3306;

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);
if ($mysqli->connect_errno) {
    http_response_code(500);
    die('Falha na conexão com o banco de dados: ' . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');
?>
