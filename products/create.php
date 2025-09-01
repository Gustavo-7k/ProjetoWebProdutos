<?php
require_once __DIR__ . '/../includes/auth.php';
require_auth();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/app.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $categoria_id = (int)($_POST['categoria_id'] ?? 0);
    $preco = (float)($_POST['preco'] ?? 0);
    $disponivel = isset($_POST['disponivel']) ? (int)$_POST['disponivel'] : 1;

    if ($nome === '' || $descricao === '' || $categoria_id <= 0 || $preco < 0) {
        $error = 'Preencha todos os campos obrigatórios.';
    } else {
        $stmt = $mysqli->prepare('INSERT INTO produtos (nome, descricao, categoria_id, preco, disponivel) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('ssidi', $nome, $descricao, $categoria_id, $preco, $disponivel);
        if ($stmt->execute()) {
            header('Location: ' . SITE_BASE . '/products/index.php');
            exit;
        } else {
            $error = 'Erro ao inserir produto.';
        }
    }
}

$produto = [];
include __DIR__ . '/../includes/header.php';
?>
<h1 class="h4 mb-3">Novo Produto</h1>
<?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
<form method="post">
  <?php include __DIR__ . '/form_fields.php'; ?>
  <div>
    <button class="btn btn-primary" style="background-color: #556B2F; color: #fff;">Salvar</button>
    <a class="btn btn-danger" style="background-color: #B22222; color: #fff; border: none;" href="<?php echo SITE_BASE; ?>/products/index.php">Cancelar</a>
  </div>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>
