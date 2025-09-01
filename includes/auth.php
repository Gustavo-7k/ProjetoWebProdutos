<?php
// Session + auth guard helpers
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/app.php';

function is_authenticated(): bool {
    return isset($_SESSION['user']);
}

function require_auth(): void {
    if (!is_authenticated()) {
    header('Location: ' . SITE_BASE . '/auth/login.php');
        exit;
    }
}
?>
