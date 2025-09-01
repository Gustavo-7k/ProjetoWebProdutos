<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/app.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Informe usuário e senha.';
    } else {
    $stmt = $mysqli->prepare('SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && $password === $user['password']) {
      $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username']
      ];
      header('Location: ' . SITE_BASE . '/index.php');
      exit;
    } else {
      $error = 'Credenciais inválidas.';
    }
    }
}

include __DIR__ . '/../includes/header.php';
?>
<div class="row justify-content-center">
  <div class="col-12 col-sm-8 col-md-6 col-lg-4">
    <h1 class="h4 mb-3">Login</h1>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Usuário</label>
        <input type="text" name="username" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
