<!DOCTYPE html>
<html>
<head>
  <title>Carrinho</title>
  <style>
        .yo{
      overflow-y: auto;
      max-height: 400px;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    h1 {
      margin-bottom: 20px;
      text-align: center;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      justify-content: space-between;
    }

    .left-column {
      flex-grow: 1;
    }

    .right-column {
      flex-shrink: 0;
      margin-left: 20px;
      width: 200px;
    }

    .product-container {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
    }

    .product-details {
      flex-grow: 1;
      margin-left: 10px;
    }

    .product-image {
      width: 100px;
      object-fit: cover;
    }

    .product-name {
      font-weight: bold;
    }

    .product-price {
      margin-top: 5px;
    }

    .product-color {
      font-size: 14px;
      color: #888;
    }

    .product-size {
      font-size: 14px;
      color: #888;
    }

    .product-quantity {
      font-size: 14px;
      color: #888;
    }

    .cart-summary {
      border-top: 1px solid #ccc;
      padding-top: 20px;
      text-align: center;
    }

    .total-price {
      font-weight: bold;
    }

    .product-quantity-total {
      color: #888;
    }

    .section-container {
      margin-bottom: 20px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .section-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .section-content {
      margin-top: 10px;
    }

    .section-content p {
      margin: 5px 0;
    }

    .complete-payment-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
    }

    .complete-payment-button:hover {
      background-color: #0056b3;
    }

    .payment-completed {
      color: green;
      margin-top: 10px;
    }
    .center-text {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px; /* Set the height to the full viewport height */
  text-align: center;
}

    .go-back-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 10px;
    }

    .go-back-button:hover {
      background-color: #0056b3;
    }
    .product-color .color-ball {
  display: inline-block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  margin-right: 5px;
}

.product-color .color-ball::before {
  content: "";
  display: block;
  width: 100%;
  height: 100%;
  border-radius: 50%;
}

.product-color .color-ball::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: block;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background-color: #fff;
}
.product-details .product-price {
  margin-top: 5px;
  display: flex;

  align-items: baseline;
}

.product-details .promotion-price {

  color: red;
}
  </style>
</head>
<body>
<div class="container">
  <div class="left-column">
    <h1>Carrinho</h1>
    <div class="yo">
      <?php if (!empty($cartProducts)) : ?>
        <?php foreach ($cartProducts as $product) : ?>
          <div class="product-container">
            <img src="<?php echo base_url('uploads/' . $product->image); ?>" alt="<?php echo $product->name; ?>" class="product-image">
            <div class="product-details">
              <div class="product-name"><?php echo $product->name; ?></div>
              <?php if (!empty($product->promotion)) : ?>
                <div class="product-price promotion-price"><?php echo $product->final_price; ?>€</div>
              <?php else : ?>
                <div class="product-price"><?php echo $product->price; ?>€</div>
              <?php endif; ?>
              <div class="product-color">Cor: <span class="color-ball" style="background-color: <?php echo $product->selected_color; ?>"></span></div>
              <div class="product-size">Tamanho: <?php echo $product->selected_size; ?></div>
              <div class="product-quantity">
                Quantidade:
                <button class="quantity-control" data-product-id="<?php echo $product->id; ?>" data-action="decrease">-</button>
                <span class="quantity-value"><?php echo $product->total_quantity; ?></span>
                <button class="quantity-control" data-product-id="<?php echo $product->id; ?>" data-action="increase">+</button>
              </div>
              
            </div>
          </div>
        <?php endforeach; ?>
      </div>

        <div class="section-container">
          <div class="section-title">Localização</div>
          <div class="section-content">
            <p>Primeiro Nome: <?php echo $first_name; ?></p>
            <p>Último Nome: <?php echo $last_name; ?></p>
            <p>País: <?php echo $country; ?></p>
            <p>Morada: <?php echo $address; ?></p>
            <p>Número de Telefone: <?php echo $phone_number; ?></p>
            <p>Código Postal: <?php echo $postal_code; ?></p>
          </div>
          <a href="<?php echo site_url('local'); ?>" class="complete-payment-button">Editar Localização</a>
        </div>

        <div class="section-container">
          <div class="section-title">Detalhes do Cartão</div>
          <div class="section-content">
            <p>Número do Cartão: <?php echo $cardNumber; ?></p>
            <p>Validade do Cartão: <?php echo $cardExpiry; ?></p>
            <p>CVV do Cartão: <?php echo $cardCvv; ?></p>
          </div>
          <a href="<?php echo site_url('cart/pagar'); ?>" class="complete-payment-button">Editar Detalhes do Cartão</a>
        </div>
        <?php else : ?>
        <div class="center-text">
        <p style="font-size: 20px;">O seu carrinho está vazio.</p>
        </div>
        <div class="center-text">
        <a style="font-size: 20px;" href="<?php echo site_url('roupa'); ?>" class="go-back-button">Explorar Roupas</a>
        </div>
        <?php endif; ?>
      <?php if (!empty($cartProducts)) : ?>
  <a href="<?php echo site_url('cart/clear'); ?>">Limpar Carrinho</a>
<?php endif; ?>
    </div>

    <div class="right-column">
  <?php if (!empty($cartProducts)) : ?>
    <div class="cart-summary">
      <div class="total-price">Total: <span id="totalPrice"><?php echo $totalPrice; ?></span>€</div>
      <div class="product-quantity-total">Número de Produtos: <span id="totalQuantity"><?php echo $totalQuantity; ?></span></div>
      <a href="<?php echo site_url('cart/completePayment'); ?>" class="complete-payment-button">Finalizar Pagamento</a>
      <?php if ($this->uri->segment(3) === 'completed') : ?>
    <p class="pedido-finalizado">Seu pedido foi finalizado com sucesso!</p>
<?php endif; ?>
    </div>
  <?php endif; ?>
</div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Load quantity values from cookies on page load
  $('.quantity-value').each(function() {
    var productId = $(this).data('product-id');
    var quantity = getCookie(productId);

    if (quantity) {
      $(this).text(quantity);
      updateCartItemTotal($(this));
    }
  });

  $('.quantity-control').on('click', function(event) {
    event.preventDefault();

    var quantityElement = $(this).siblings('.quantity-value');
    var currentQuantity = parseInt(quantityElement.text());
    var updatedQuantity = currentQuantity;

    if ($(this).data('action') === 'increase') {
      updatedQuantity = currentQuantity + 1;
    } else if ($(this).data('action') === 'decrease' && currentQuantity > 1) {
      updatedQuantity = currentQuantity - 1;
    }

    quantityElement.text(updatedQuantity);

    var productId = $(this).data('product-id');
    setCookie(productId, updatedQuantity.toString()); // Save the updated quantity to cookie

    updateCartItemTotal(quantityElement);
    updateCartSummary();
  });

  function updateCartItemTotal(quantityElement) {
    var quantity = parseInt(quantityElement.text());
    var productContainer = quantityElement.closest('.product-container');
    var priceElement = productContainer.find('.product-price');
    var finalPriceElement = productContainer.find('.promotion-price');

    var price = parseFloat(priceElement.text().replace('€', '').trim());
    var finalPrice = parseFloat(finalPriceElement.text().replace('€', '').trim());

    var totalPrice = finalPriceElement.length > 0 ? quantity * finalPrice : quantity * price;
    productContainer.find('.total-price').text(totalPrice.toFixed(2) + '€');
  }

  function updateCartSummary() {
    var totalPrice = 0;
    var totalQuantity = 0;

    $('.product-container').each(function() {
      var quantity = parseInt($(this).find('.quantity-value').text());
      var priceElement = $(this).find('.product-price');
      var finalPriceElement = $(this).find('.promotion-price');

      var price = parseFloat(priceElement.text().replace('€', '').trim());
      var finalPrice = parseFloat(finalPriceElement.text().replace('€', '').trim());

      if (finalPriceElement.length > 0) {
        totalPrice += quantity * finalPrice;
      } else {
        totalPrice += quantity * price;
      }

      totalQuantity += quantity;
    });

    $('#totalPrice').text(totalPrice.toFixed(2));
    $('#totalQuantity').text(totalQuantity);
  }

  // Set a cookie
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
  }

  // Get a cookie value
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Update the cart summary initially
  updateCartSummary();
});
</script>
</body>
</html>
