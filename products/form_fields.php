<?php
// Utility partial to render category select and shared fields
require_once __DIR__ . '/../config/db.php';
$cats = $mysqli->query('SELECT id, categoria FROM categorias ORDER BY categoria')->fetch_all(MYSQLI_ASSOC);
?>
<div class="mb-3">
  <label class="form-label">Nome do produto</label>
  <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($produto['nome'] ?? ''); ?>" required />
</div>
<div class="mb-3">
  <label class="form-label">Descrição</label>
  <textarea name="descricao" class="form-control" rows="4" required><?php echo htmlspecialchars($produto['descricao'] ?? ''); ?></textarea>
</div>
<div class="mb-3">
  <label class="form-label">Categoria</label>
  <select name="categoria_id" class="form-select" required>
    <option value="">Selecione...</option>
    <?php foreach ($cats as $c): ?>
      <option value="<?php echo (int)$c['id']; ?>" <?php echo isset($produto['categoria_id']) && (int)$produto['categoria_id'] === (int)$c['id'] ? 'selected' : ''; ?>>
        <?php echo htmlspecialchars($c['categoria']); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>
<div class="mb-3">
  <label class="form-label">Preço</label>
  <input type="number" name="preco" class="form-control" step="0.01" min="0" value="<?php echo htmlspecialchars($produto['preco'] ?? ''); ?>" required />
</div>
<div class="mb-3">
  <label class="form-label">Disponibilidade</label>
  <?php $disp = isset($produto['disponivel']) ? (int)$produto['disponivel'] : 1; ?>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="disponivel" id="disp1" value="1" <?php echo $disp === 1 ? 'checked' : ''; ?>>
    <label class="form-check-label" for="disp1">Disponível</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="disponivel" id="disp0" value="0" <?php echo $disp === 0 ? 'checked' : ''; ?>>
    <label class="form-check-label" for="disp0">Indisponível</label>
  </div>
</div>
