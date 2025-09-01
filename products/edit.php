<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: ' . SITE_BASE . '/products/index.php'); exit; }

$error = '';
$stmt = $mysqli->prepare('SELECT * FROM produtos WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$produto = $stmt->get_result()->fetch_assoc();
if (!$produto) { header('Location: ' . SITE_BASE . '/products/index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $categoria_id = (int)($_POST['categoria_id'] ?? 0);
    $preco = (float)($_POST['preco'] ?? 0);
    $disponivel = isset($_POST['disponivel']) ? (int)$_POST['disponivel'] : 1;

    if ($nome === '' || $descricao === '' || $categoria_id <= 0 || $preco < 0) {
        $error = 'Preencha todos os campos obrigatórios.';
    } else {
        $stmt = $mysqli->prepare('UPDATE produtos SET nome = ?, descricao = ?, categoria_id = ?, preco = ?, disponivel = ? WHERE id = ?');
        $stmt->bind_param('ssidii', $nome, $descricao, $categoria_id, $preco, $disponivel, $id);
        if ($stmt->execute()) {
            header('Location: ' . SITE_BASE . '/products/index.php');
            exit;
        } else {
            $error = 'Erro ao atualizar produto.';
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>
<h1 class="h4 mb-3">Editar Produto</h1>
<?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
<form method="post">
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div>
    <button class="btn btn-primary" style="background-color: #556B2F; color: #fff;">Salvar</button>
    <a class="btn btn-danger" style="background-color: #B22222; color: #fff; border: none;" href="<?php echo SITE_BASE; ?>/products/index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
