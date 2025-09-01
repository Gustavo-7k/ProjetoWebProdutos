<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$result = $mysqli->query('SELECT id, categoria FROM categorias ORDER BY categoria');
include __DIR__ . '/../includes/header.php';
?>
<?php if (isset($_GET['err']) && $_GET['err'] === 'used'): ?>
  <div class="alert alert-warning">Não é possível excluir a categoria porque ela está em uso por um ou mais produtos.</div>
<?php endif; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4">Categorias</h1>
  <a href="<?php echo SITE_BASE; ?>/categories/create.php" class="btn btn-primary">Nova Categoria</a>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Categoria</th>
      <th class="text-end">Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo (int)$row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
        <td class="text-end">
          <a class="btn btn-sm btn-secondary" href="<?php echo SITE_BASE; ?>/categories/edit.php?id=<?php echo (int)$row['id']; ?>">Editar</a>
          <a class="btn btn-sm btn-danger" href="<?php echo SITE_BASE; ?>/categories/delete.php?id=<?php echo (int)$row['id']; ?>" onclick="return confirm('Excluir esta categoria?');">Excluir</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
