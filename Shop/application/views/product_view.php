<!DOCTYPE html>
<html>
<head>
  <title>Product Page</title>
  <style>
    .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1000px;
      margin: 0 auto;
    }

    .product-image {
      flex-shrink: 0;
      width: 400px;
      height: auto;
      object-fit: contain;
      margin-right: 20px;
      cursor: pointer;
    }

    .product-details {
      flex-grow: 1;
      font-size: 18px;
      padding: 20px;
      border-radius: 5px;
      margin-bottom: 20px;
      background-color: #fff;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .product-details h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .product-details p {
      margin: 0;
    }

    .product-details .available-options {
      margin-top: 20px;
    }

    .product-details .available-options h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .product-details .available-options ul {
      list-style-type: none;
      padding: 0;
    }

    .product-details .available-options ul li {
      display: inline-block;
      margin-right: 10px;
    }

    .product-details .available-options ul li .color-ball {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin-right: 5px;
    }

    .product-details .available-options ul li .size-ball {
      display: inline-block;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 1px solid #000;
      margin-right: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .product-details .available-options ul li .selected-ball {
      display: inline-block;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      border: 2px solid #000;
      margin-right: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .product-details .add-to-cart {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end;
}

    .product-details .add-to-cart p {
      margin-bottom: 10px;
    }


.product-details .add-to-cart button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  
}

    .modal {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }

    .modal.show {
      opacity: 1;
      pointer-events: auto;
    }

    .modal-content {
      position: relative;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      max-width: 100%;
      max-height: 100%;
    }

    .modal-image {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .product-details .price-container {
  display: flex;
  align-items: baseline;
}

.product-details .price-container p {
  margin: 0;
  font-size: 18px;
}

.product-details p.price {
  margin-right: 10px;

  text-decoration: <?php echo (!empty($product->promotion)) ? 'line-through' : 'none'; ?>;
}

.product-details p.promotion {
  color: red;
}
  </style>
</head>
<body>
  
  <div class="container">
    <div class="product-image" onclick="openModal()">
      <img src="<?php echo base_url("uploads/".$product->image); ?>" alt="<?php echo $product->name; ?>">
    </div>

    <div class="product-details">
  <h2><?php echo $product->name; ?></h2>
  <?php if (!empty($product->promotion)): ?>
    <div class="price-container">
      <p class="price"><?php echo number_format($product->price, 2); ?>€</p>
      <p class="promotion"><?php echo number_format($product->final_price, 2); ?>€</p>
    </div>
  <?php else: ?>
    <p class="price"><?php echo number_format($product->price, 2); ?>€</p>
  <?php endif; ?>
      <div class="available-options">
        <h3>Tamanhos Disponíveis:</h3>
        <ul>
          <?php
          $selectedSize = '';
          $selectedColor = '';
          $availableSizes = explode(',', $product->size);
          foreach ($availableSizes as $size) {
            echo '<li><span class="size-ball" onclick="selectSize(\'' . $size . '\')">' . $size . '</span></li>';
          }
          ?>
          <?php if ($selectedSize !== ''): ?>
            <li><span class="selected-ball"><?php echo $selectedSize; ?></span></li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="available-options">
        <h3>Cores Disponíveis:</h3>
        <ul>
          <?php
          $availableColors = explode(',', $product->color);
          foreach ($availableColors as $color) {
            echo '<li><span class="color-ball" onclick="selectColor(\'' . $color . '\')" style="background-color: ' . $color . '"></span></li>';
          }
          ?>
          <?php if ($selectedColor !== ''): ?>
            <li><span class="selected-ball" style="background-color: <?php echo $selectedColor; ?>"></span></li>
          <?php endif; ?>
        </ul>
      </div>

      <?php if (!$this->session->userdata('logged_in')): ?>
        <div class="add-to-cart">
          <p>Precisa iniciar sessão para adicionar este produto ao seu carrinho.</p>
          <button href="#" onclick="history.back();">Voltar</button>
        </div>
      <?php else: ?>
        <div class="add-to-cart">
          <form id="addToCartForm" action="<?php echo site_url('cart/add'); ?>" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
            <button id="addToCartButton" type="submit">Adicionar ao Carrinho</button>
            <button href="#" onclick="history.back();">Voltar</button>

          </form>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Modal Dialog -->
<div class="modal" id="modal" onclick="closeModal()">
  <div class="modal-content">
    <img class="modal-image" src="<?php echo base_url("uploads/".$product->image); ?>" alt="<?php echo $product->name; ?>">
  </div>
</div>


  <script>
    var selectedSize = '<?php echo $selectedSize; ?>';
    var selectedColor = '<?php echo $selectedColor; ?>';
    var selectedSizeBall = null;
    var selectedColorBall = null;

    function selectSize(size) {
      selectedSize = size;
      updateSelectedOptions();
    }

    function selectColor(color) {
      selectedColor = color;
      updateSelectedOptions();
    }

    function updateSelectedOptions() {
      var sizeBalls = document.querySelectorAll('.size-ball');
      sizeBalls.forEach(function(ball) {
        ball.classList.remove('selected-ball');
        if (ball.innerText === selectedSize) {
          ball.classList.add('selected-ball');
          selectedSizeBall = ball;
        }
      });

      var colorBalls = document.querySelectorAll('.color-ball');
      colorBalls.forEach(function(ball) {
        ball.classList.remove('selected-ball');
        if (ball.style.backgroundColor === selectedColor) {
          ball.classList.add('selected-ball');
          selectedColorBall = ball;
        }
      });
    }

    function animateSelection() {
      if (selectedSizeBall) {
        selectedSizeBall.animate(
          [{ transform: 'scale(1)', opacity: 1 }, { transform: 'scale(1)', opacity: 0.8 }],
          { duration: 300, easing: 'ease-in-out', fill: 'forwards' }
        );
      }

      if (selectedColorBall) {
        selectedColorBall.animate(
          [{ transform: 'scale(1)', opacity: 1 }, { transform: 'scale(1)', opacity: 0.8 }],
          { duration: 300, easing: 'ease-in-out', fill: 'forwards' }
        );
      }
    }

    function addToCart() {
      if (selectedSize && selectedColor) {
        var product_id = <?php echo $product->id; ?>;
        var formData = new FormData();
        formData.append('product_id', product_id);
        formData.append('selected_size', selectedSize);
        formData.append('selected_color', selectedColor);

        // Make an AJAX request to add the product to the cart
        fetch('<?php echo site_url('cart/add'); ?>', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          // Update the cart count
          var cartCount = parseInt(data);
          if (!isNaN(cartCount)) {
            // Update the cart count in the UI
            var cartCountElement = document.getElementById('cartCount');
            if (cartCountElement) {
              cartCountElement.innerText = cartCount;
            }

          } else {
            alert('Esse produto já está no carrinho.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Erro ao adicionar item ao carrinho.');
        });
      } else {
        alert('Por favor, selecione um tamanho e uma cor.');
      } 
    }

    function openModal() {
      var modal = document.getElementById('modal');
      modal.classList.add('show');
    }

    function closeModal() {
      var modal = document.getElementById('modal');
      modal.classList.remove('show');
    }

    var sizeBalls = document.querySelectorAll('.size-ball');
    sizeBalls.forEach(function(ball) {
      ball.addEventListener('click', function() {
        selectSize(this.innerText);
        selectedSizeBall = this;
        animateSelection();
      });
    });

    var colorBalls = document.querySelectorAll('.color-ball');
    colorBalls.forEach(function(ball) {
      ball.addEventListener('click', function() {
        selectColor(this.style.backgroundColor);
        selectedColorBall = this;
        animateSelection();
      });
    });

    // Attach click event listener to Add to Cart button
    var addToCartButton = document.getElementById('addToCartButton');
    addToCartButton.addEventListener('click', function(event) {
      event.preventDefault();
      addToCart();
    });

    // Close the modal if clicked outside the modal content
    window.addEventListener('click', function(event) {
      var modal = document.getElementById('modal');
      if (event.target === modal) {
        closeModal();
      }
    });
    function closeModal() {
  var modal = document.getElementById('modal');
  modal.classList.remove('show');
}

  </script>
</body>
</html>
