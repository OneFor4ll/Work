<!DOCTYPE html>
<html>
<head>
  <title>Detalhes do Produto</title>
  <style>
    .form-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px; 
    }

    .color-options {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 5px; 
    }

    .type-options {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      margin-bottom: 5px; 
    }

    .color-arrows {
      display: flex;
      align-items: center;
    }

    .color-arrow {
      display: flex;
      align-items: center;
      margin-right: 5px;
      cursor: pointer;
    }

    .color-arrow i {
      margin: 0 5px;
      margin-right: 5px;
    }

    .color-expand {
      width: 20px;
      height: 20px;
      background-image: url('arrow.png');
      background-repeat: no-repeat;
      background-size: contain;
      cursor: pointer;
    }

    .color-options.expanded {
      flex-wrap: wrap;
      max-height: 200px; 
      overflow-y: auto;
    }

    .color-ball {
      display: inline-block;
      align-items: center; 
      width: 25px;
      height: 25px;
      border-radius: 50%;
      margin-right: 5px;
      cursor: pointer;
      transition: opacity 0.3s, transform 0.3s; 
    }

    .color-ball.hide {
      opacity: 0;
      transform: scale(0); 
    }

    .color-ball:hover {
      opacity: 0.8; 
      transform: scale(1.2); 
    }

    .color-red {
      background-color: red;
    }

    .color-blue {
      background-color: blue;
    }

    .color-black {
      background-color: black;
    }

    .type-option {
      display: inline-block;
      padding: 5px 10px;
      margin-left: 10px;
      margin-right: 5px;
      margin-bottom: 5px;
      border-radius: 5px;
      cursor: pointer;
      font-size: large;
    }

    .type-option.selected {
      color: orange;
    }

    
    .selected{
      color: orange;
    }
    .promotion {
      color: red;
    }

    .product-list {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 5px;
      font-size: 20px;
      margin-left: 10px;
      margin-right: 10px;
    }

    .product-item {
      text-align: inline-block;
    }

    .product-item img {
      max-width: 100%;
      height: auto;
    }

    .no-products-message {
      font-weight: bold;
      color: red;
    }

    h3 {
      font-weight: normal;
    }

    header {
      margin-bottom: 20px; 
    }

    .container {
      display: flex;
      gap: 10px;
    }

    
  </style>
</head>
<body>
  <form action="<?php echo base_url('roupa'); ?>" method="get">
    <div class="form-row">
      <div class="col-md-3 mb-3">
        <div class="type-options">
          <span class="type-option <?php if(empty($selectedType)) echo 'selected'; ?>" data-type="">Todos</span>
          <span class="type-option <?php if($selectedType === 'Skirts') echo 'selected'; ?>" data-type="Saia">Saias</span>
          <span class="type-option <?php if($selectedType === 'Pants') echo 'selected'; ?>" data-type="Calça">Calças</span>
          <span class="type-option <?php if($selectedType === 'Tops') echo 'selected'; ?>" data-type="Tops">Tops</span>
          <span class="type-option <?php if($selectedType === 'Dresses') echo 'selected'; ?>" data-type="Vestido">Vestidos</span>
        </div>
        <input type="hidden" name="type" id="selected-type" value="<?php echo $selectedType; ?>">
      </div>
      <div class="color-options">
        <div class="color-arrows">
          <span class="color-arrow" id="color-left"><i class="fas fa-chevron-left"></i></span>
          <span class="color-ball color-red" data-color="red"></span>
          <span class="color-ball color-blue" data-color="blue"></span>
          <span class="color-ball color-black" data-color="black"></span>
          <span class="color-arrow" id="color-right"><i class="fas fa-chevron-right"></i></span>
        </div>
        <input type="hidden" name="color" id="selected-color" value="">
      </div>
    </div>
  </form>
  <div class="product-list">
    <?php if (empty($products)): ?>
      <p class="no-products-message">Não há produtos disponíveis com os filtros selecionados.</p>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <?php
        ?>
        <div class="product-item" onclick="window.location.href='<?php echo base_url('roupa/'.$product->id); ?>'">
          <img src="<?php echo base_url("uploads/".$product->image); ?>" alt="<?php echo $product->name; ?>">
          <h3><?php echo $product->name; ?></h3>
          <?php if (!empty($product->promotion)): ?>
            <div class="container">
            <p class="promotion"><?php echo number_format($product->final_price, 2); ?>€</p>
            <del><?php echo number_format($product->price, 2); ?>€</del>
            </div>  
          <?php else: ?>
            <?php echo number_format($product->price, 2); ?>€</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
  const colorBalls = document.querySelectorAll('.color-ball');
  const selectedColorInput = document.getElementById('selected-color');
  const clrcode = new URLSearchParams(window.location.search).get("color");
  const toHide = [];
  if (clrcode) {
    colorBalls.forEach(b => {
      if (b.getAttribute("data-color") != clrcode) toHide.push(b)
    });
    toHide.forEach(b => {
      b.classList.add("hide")
      setTimeout(() => {
        b.style.display = "none";
      }, 0);
    });
  }
  colorBalls.forEach(ball => {
    ball.addEventListener('click', e => {
      const color = ball.dataset.color;
      selectedColorInput.value = color;

      ball.classList.add('selected');
      // Submit the form when a color is selected
      document.querySelector('form').submit();
    });

    ball.addEventListener('mouseover', e => {
      toHide.forEach(b => {
        b.classList.remove("hide")
        setTimeout(() => {
          b.style.display = "unset";
        }, 0);
      });
    });
  });

  const typeOptions = document.querySelectorAll('.type-option');
  const selectedTypeInput = document.getElementById('selected-type');

  // Retrieve the selected type from the URL parameter
  const urlParams = new URLSearchParams(window.location.search);
  const selectedType = urlParams.get('type');

  typeOptions.forEach(option => {
    option.classList.remove('selected');
  });

  typeOptions.forEach(option => {
    if (option.dataset.type === selectedType || (!selectedType && option.dataset.type === "")) {
      option.classList.add('selected');
      selectedTypeInput.value = option.dataset.type;
    }
  });

  typeOptions.forEach(option => {
    option.addEventListener('click', () => {
      const type = option.dataset.type;
      selectedTypeInput.value = type;
      typeOptions.forEach(o => o.classList.remove('selected'));
      option.classList.add('selected');

      // Submit the form when a type is selected
      document.querySelector('form').submit();
    });
  });
</script>
</body>
</html>
