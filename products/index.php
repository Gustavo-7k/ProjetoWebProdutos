<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$sql = 'SELECT p.id, p.nome, p.preco, p.disponivel, c.categoria 
        FROM produtos p 
        LEFT JOIN categorias c ON c.id = p.categoria_id
        ORDER BY p.id DESC';
$result = $mysqli->query($sql);
include __DIR__ . '/../includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4">Produtos</h1>
  <a href="<?php echo SITE_BASE; ?>/products/create.php" class="btn btn-primary">Novo Produto</a>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Categoria</th>
      <th>Preço</th>
      <th>Disponível</th>
      <th class="text-end">Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo (int)$row['id']; ?></td>
      <td><?php echo htmlspecialchars($row['nome']); ?></td>
      <td><?php echo htmlspecialchars($row['categoria'] ?? '—'); ?></td>
      <td>R$ <?php echo number_format((float)$row['preco'], 2, ',', '.'); ?></td>
      <td>
        <?php if ((int)$row['disponivel'] === 1): ?>
          <span class="badge bg-success">Disponível</span>
        <?php else: ?>
          <span class="badge bg-secondary">Indisponível</span>
        <?php endif; ?>
      </td>
      <td class="text-end">
  <a class="btn btn-sm btn-secondary" href="<?php echo SITE_BASE; ?>/products/edit.php?id=<?php echo (int)$row['id']; ?>">Editar</a>
  <a class="btn btn-sm btn-danger" href="<?php echo SITE_BASE; ?>/products/delete.php?id=<?php echo (int)$row['id']; ?>" onclick="return confirm('Excluir este produto?');">Excluir</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../includes/footer.php'; ?>
