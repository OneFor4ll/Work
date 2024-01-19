<!DOCTYPE html>
<html>
<head>
  <title>Produtos</title>
  <style>
  label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin: 10px;
}

 h2{
  margin: 10px;
 }

.add-product {
  width: 300px;
  margin-right: 20px;
}

.add-product label {
  margin-top: 5px;
}

.add-product input,
.add-product select {
  width: 100%;
  padding: 5px;
  margin-top: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

.add-product input[type="submit"],
.delete-all-products a {
  display: inline-block;
  padding: 8px 16px;
  background-color: #4caf50;
  color: #fff;
  font-size: 17px;
  text-decoration: none;
  border: none;
  border-radius: 3px;
  transition: background-color 0.3s ease;
  width: 100%;
  text-align: center;
  box-sizing: border-box;
}

.add-product input[type="submit"]:hover,
.delete-all-products a:hover {
  background-color: #45a049;
}

.add-product a {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 16px;
  background-color: #f44336;
  color: #fff;
  text-decoration: none;
  border-radius: 3px;
  transition: background-color 0.3s ease;
}

.add-product a:hover {
  background-color: #d32f2f;
}

.product-list-container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  flex-grow: 1;
}

.product-list-container table {
  width: 95%;
  font-size: 17px;
}

.product-list-container th,
.product-list-container td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

.product-list-container th {
  background-color: #f2f2f2;
}

.product-image {
  width: 80px;
}

.product-actions {
  white-space: nowrap;
}

.product-actions a {
  margin-right: 5px;
  background-color: #f2f2f2;
  color: #333;
  padding: 5px 10px;
  text-decoration: none;
  border-radius: 3px;
}

.product-actions a.edit {
  background-color: #4caf50;
  color: #fff;
}

.product-actions a.delete {
  background-color: #f44336;
  color: #fff;
}

.delete-all-products {
  text-align: left;
}

.delete-all-products a {
  display: inline-block;
  padding: 8px 16px;
  background-color: #4caf50;
  color: #fff;
  border-radius: 3px;
  transition: background-color 0.3s ease;
  width: 100%;
  text-align: center;
}

.delete-all-products a:hover {
  background-color: #d32f2f;
}

.pagination-links {
  margin-top: 20px;
}

.pagination-links a {
  display: inline-block;
  padding: 5px 10px;
  background-color: #f2f2f2;
  color: #333;
  text-decoration: none;
  margin-right: 5px;
}

.pagination-links .current-page {
  display: inline-block;
  padding: 5px 10px;
  background-color: #333;
  color: #fff;
  margin-right: 5px;
}

.pagination-links a:hover {
  background-color: #ddd;
}

.cores {
  display: flex;
}


.cores > div {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.cores input[type="checkbox"] {
  margin-right: 5px;
}

.cores label {
  margin-bottom: 0;
}

.tamanhos {
  display: flex;
}

.tamanhos > div {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.tamanhos input[type="checkbox"] {
  margin-right: 5px;
}

.tamanhos label {
  margin-bottom: 0;
}

</style>


</head>
<body>
  <?php if (isset($is_edit) && $is_edit === true): ?>
    <h2>Editar Produto</h2>
  <?php else: ?>
    <h2>Adicionar Produto</h2>
  <?php endif; ?>

  <div class="container">
    <div class="add-product">
      <?php echo validation_errors(); ?>
      <?php if (isset($is_edit) && $is_edit === true): ?>
        <?php echo form_open_multipart('products/edit/'.$product['id']); ?>
      <?php else: ?>
        <?php echo form_open_multipart('products/add'); ?>
      <?php endif; ?>

      <label for="name">Nome da Roupa:</label>
      <input type="text" name="name" id="name" value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>" required>

      <label for="price">Preço:</label>
      <input type="text" name="price" id="price" placeholder="€" value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>" required>


      <label for="promotion">Promoção (%):</label>
      <input type="text" name="promotion" id="promotion" placeholder ="%" value="<?php echo !empty($product['promotion']) ? $product['promotion'] : ''; ?>" required>


      <label for="image">Imagem:</label>
      <input type="file" name="image" id="image" value="<?php echo $product['image'] ?? ""; ?>" <?php if (empty($is_edit) || !$is_edit) echo "required" ?> />

      <label for="type">Tipo:</label>
      <select name="type" id="type" required>
        <option <?= (isset($product['type']) && $product['type'] === "Skirts") ? "selected" : ""; ?> value="Saia">Saia</option>
        <option <?= (isset($product['type']) && $product['type'] === "Pants") ? "selected" : ""; ?> value="Calça">Calça</option>
        <option <?= (isset($product['type']) && $product['type'] === "Tops") ? "selected" : ""; ?> value="Tops">Tops</option>
        <option <?= (isset($product['type']) && $product['type'] === "Dresses") ? "selected" : ""; ?> value="Vestido">Vestido</option>
      </select>

      <label>Cor:</label>
<div class="cores">
  <div>
    <input type="checkbox" name="color[]" id="red" value="Red" <?php echo (isset($product['color']) && preg_match("/red/i", $product['color'])) ? "checked" : ""; ?>>
    <label for="red">Vermelho</label>
  </div>
  <div>
    <input type="checkbox" name="color[]" id="blue" value="Blue" <?php echo (isset($product['color']) && preg_match("/blue/i", $product['color']))  ? "checked" : ""; ?>>
    <label for="blue">Azul</label>
  </div>
  <div>
    <input type="checkbox" name="color[]" id="black" value="Black" <?php echo (isset($product['color']) && preg_match("/black/i", $product['color'])) ? "checked" : ""; ?>>
    <label for="black">Preto</label>
  </div>
</div>


<label>Tamanho:</label>

<div class="tamanhos">
  <div>
    <input type="checkbox" name="size[]" id="sizeS" value="S" <?php echo (isset($product['size']) && preg_match("/S/i", $product['size']))  ? "checked" : ""; ?>>
    <label for="sizeS">S</label>
  </div>
  <div>
    <input type="checkbox" name="size[]" id="sizeM" value="M" <?php echo (isset($product['size']) && preg_match("/M/i", $product['size'])) ? "checked" : ""; ?>>
    <label for="sizeM">M</label>
  </div>
  <div>
    <input type="checkbox" name="size[]" id="sizeL" value="L" <?php echo (isset($product['size']) && preg_match("/L/i", $product['size']))? "checked" : ""; ?>>
    <label for="sizeL">L</label>
  </div>
  <div>
    <input type="checkbox" name="size[]" id="sizeXL" value="XL" <?php echo (isset($product['size']) && preg_match("/XL/i", $product['size'])) ? "checked" : ""; ?>>
    <label for="sizeXL">XL</label>
  </div>
</div>


      <input type="submit" value="<?php echo isset($is_edit) && $is_edit === true ? 'Editar Produto' : 'Adicionar Produto'; ?>">
      <?php echo form_close(); ?>
      <div class="delete-all-products">
      <?php if (isset($is_edit) && $is_edit) : ?>
    <a href="<?php echo base_url('products'); ?>" class="btn btn-secondary">Cancelar</a>
<?php endif; ?>
        <a href="<?= base_url('products/delete_all') ?>" onclick="return confirmDeleteAll()">Excluir todos os produtos</a>
      
      </div>
    </div>
    

    <div class="product-list-container">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>ID do utilizador</th>
            <th>Nome</th>
            <th>Imagem</th>
            <th>Promoção (%)</th>
            <th>Preço Final</th>
            <th>Tipo</th>
            <th>Cor</th>
            <th>Tamanho</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php // var_dump($products)?>

          <?php foreach ($products as $product): ?>
            <tr>
              <td><?php echo $product['id']; ?></td>
              <td><?php echo $product['user_id']; ?></td>
              <td><?php echo $product['name']; ?></td>
              <td>
                <?php if (!empty($product['image'])): ?>
                  <img src="<?= base_url('uploads/' . $product['image']); ?>" alt="Imagem do Produto" width="100">
                <?php else: ?>
                  Nenhuma imagem disponível
                <?php endif; ?>
              </td>
              <td><?php echo isset($product['promotion']) ? $product['promotion'].'%' : '0%'; ?></td>
              <td><?php echo $product['final_price']; ?>€</td>
              <td><?php echo $product['type']; ?></td>
              <td>
              <div class="cores.so">
                <?php
                $colors = explode(",", $product['color']);
                foreach ($colors as $color) {
                  $color = trim($color);
                  echo '<div style="background-color: ' . $color . '; width: 20px; height: 20px; border-radius: 50%; "></div>';
                }
                ?>
              </div>
            </td>
              <td><?php echo $product['size']; ?></td>
              <td class="product-actions">
              <a href="<?php echo base_url('products/edit/'.$product['id'].'?page='.$currentPage); ?>">Editar</a>
                <a href="<?php echo base_url('products/delete/'.$product['id']); ?>" onclick="return confirm('Tem certeza de que deseja excluir este produto?')">Eliminar</a>
              </td>
            </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      <div class="pagination-links">
        <?php if ($totalPages > 1): ?>
          <?php if ($currentPage > 1): ?>
            <a href="<?= base_url('products?page=' . ($currentPage - 1)) ?>" class="pagination-arrow">Anterior</a>
          <?php endif; ?>
          <span class="pagination-page">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
          <?php if ($currentPage < $totalPages): ?>
            <a href="<?= base_url('products?page=' . ($currentPage + 1)) ?>" class="pagination-arrow">Próximo</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>


    <script>
  function changeItemsPerPage() {
    var itemsPerPage = document.getElementById('itemsPerPage').value;
    var url = new URL(window.location.href);
    var params = new URLSearchParams(url.search);
    params.set('page', 1);
    params.set('items_per_page', itemsPerPage);
    window.location.href = url.origin + url.pathname + '?' + params.toString();
  }
      function confirmDeleteAll() {
  return confirm("Tem certeza de que deseja excluir todos os produtos? Esta ação não pode ser desfeita.");
}

    </script>
</body>
</html>
