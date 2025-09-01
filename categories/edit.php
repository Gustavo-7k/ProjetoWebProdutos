<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: ' . SITE_BASE . '/categories/index.php'); exit; }

$error = '';
$stmt = $mysqli->prepare('SELECT id, categoria FROM categorias WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$cat = $stmt->get_result()->fetch_assoc();
if (!$cat) { header('Location: ' . SITE_BASE . '/categories/index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = trim($_POST['categoria'] ?? '');
    if ($categoria === '') {
        $error = 'Informe o nome da categoria.';
    } else {
        $stmt = $mysqli->prepare('UPDATE categorias SET categoria = ? WHERE id = ?');
        $stmt->bind_param('si', $categoria, $id);
        if ($stmt->execute()) {
            header('Location: ' . SITE_BASE . '/categories/index.php');
            exit;
        } else {
            $error = 'Erro ao atualizar categoria.';
        }
    }
}
include __DIR__ . '/../includes/header.php';
?>
<h1 class="h4 mb-3">Editar Categoria</h1>
<?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
<form method="post" class="row g-3">
  <div class="col-12 col-md-6">
    <label class="form-label">Categoria</label>
    <input type="text" name="categoria" class="form-control" value="<?php echo htmlspecialchars($cat['categoria']); ?>" required />
  </div>
  <div class="col-12">
    <button class="btn btn-primary" style="background-color: #556B2F; color: #fff;">Salvar</button>
  <a class="btn btn-danger" style="background-color: #B22222; color: #fff; border: none;" href="<?php echo SITE_BASE; ?>/categories/index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
