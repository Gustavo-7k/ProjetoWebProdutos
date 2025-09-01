<?php
require_once __DIR__ . '/includes/auth.php';
require_auth();
include __DIR__ . '/includes/header.php';
?>
<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-6 fw-bold">Bem-vindo ao Mini Sistema</h1>
    <p class="col-md-8 fs-5">Use o menu para gerenciar produtos e categorias.</p>
  </div>
</div>
<div class="row g-3">
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Produtos</h5>
        <p class="card-text">Cadastre, edite e remova produtos.</p>
  <a class="btn btn-primary" style="background-color: #556B2F; color: #fff;" href="<?php echo SITE_BASE; ?>/products/index.php">Abrir</a>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h5 class="card-title">Categorias</h5>
        <p class="card-text">Gerencie as categorias de produtos.</p>
  <a class="btn btn-secondary" style="background-color: #556B2F; color: #fff;" href="<?php echo SITE_BASE; ?>/categories/index.php">Abrir</a>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
