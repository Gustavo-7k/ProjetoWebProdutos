<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/app.php';
$_SESSION = [];
session_destroy();
header('Location: ' . SITE_BASE . '/auth/login.php');
exit;
