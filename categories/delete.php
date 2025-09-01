<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    // Prevent deletion if in use by products
    $stmt = $mysqli->prepare('SELECT COUNT(*) c FROM produtos WHERE categoria_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $count = $stmt->get_result()->fetch_assoc()['c'] ?? 0;
    if ($count > 0) {
    header('Location: ' . SITE_BASE . '/categories/index.php?err=used');
        exit;
    }
    $stmt = $mysqli->prepare('DELETE FROM categorias WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: ' . SITE_BASE . '/categories/index.php');
exit;
