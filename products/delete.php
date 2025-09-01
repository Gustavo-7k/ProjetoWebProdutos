<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $mysqli->prepare('DELETE FROM produtos WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: ' . SITE_BASE . '/products/index.php');
exit;
