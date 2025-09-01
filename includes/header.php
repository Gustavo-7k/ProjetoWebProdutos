<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../config/app.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mini Sistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<style>
  .navbar-custom {
    background-color: #380014ff !important;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?php echo SITE_BASE; ?>/index.php">Mini Sistema</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
  <?php
    $current = $_SERVER['REQUEST_URI'];
    $isProdutos = strpos($current, '/products/') !== false;
    $isCategorias = strpos($current, '/categories/') !== false;
    $isIndex = strpos($current, '/index.php') !== false && !$isProdutos && !$isCategorias;
  ?>
  <li class="nav-item">
    <a class="nav-link<?php echo $isProdutos ? ' active fw-bold' : ''; ?>" href="<?php echo SITE_BASE; ?>/products/index.php">Produtos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php echo $isCategorias ? ' active fw-bold' : ''; ?>" href="<?php echo SITE_BASE; ?>/categories/index.php">Categorias</a>
  </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo SITE_BASE; ?>/auth/logout.php">Sair</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo SITE_BASE; ?>/auth/login.php">Entrar</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container py-3">
