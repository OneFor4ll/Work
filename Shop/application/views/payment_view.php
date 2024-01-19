<!DOCTYPE html>
<html>
<head>
  <title>Pagamento</title>
  <style>
    h1 {
      margin-bottom: 20px;
      text-align: center;
    }

    form {
      background-color: #fff;
      padding: 40px;
      border-radius: 5px;
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="text"] {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 100%;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .card-input {
      display: flex;
      justify-content: space-between;
    }

    .card-input input {
      width: 32%;
    }
  </style>
  <script>
    function validateExpiry() {
      var expiryInput = document.getElementById("card_expiry");
      var pattern = /^(0[0-9]|1[0-2])\/(0[0-9]|1[0-9]|2[0-9]|3[0-1])$/;
      var isValid = pattern.test(expiryInput.value);

      if (!isValid) {
        expiryInput.setCustomValidity("Please enter a valid expiry date in the format MM/AA (e.g., 01/23).");
      } else {
        expiryInput.setCustomValidity("");
      }
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>Pagamento</h1>
    <form method="post" action="<?php echo site_url('cart/process_payment'); ?>">
      <div class="card-input">
        <label for="card_number">Número do Cartão:</label>
        <input type="text" name="card_number" id="card_number" required pattern="[0-9]{16}" maxlength="16">
      </div>

      <div class="card-input">
        <label for="card_expiry">Validade do Cartão:</label>
        <input type="text" name="card_expiry" id="card_expiry" required placeholder="MM/AA" oninput="validateExpiry()" maxlength="5">
      
        <label for="card_cvv">CVV do Cartão:</label>
        <input type="text" name="card_cvv" id="card_cvv" required pattern="[0-9]{3}" maxlength="3">
      </div>

      <input type="submit" value="Submeter Pagamento">
    </form>
  </div>
</body>
</html>
