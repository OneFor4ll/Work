<!DOCTYPE html>
<html>
<head>
  <title>Vista Local</title>
</head>
<style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      margin-bottom: 20px;
      text-align: center;
    }

    form {
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

    p {
      text-align: center;
    }
  </style>
<body>
  <h1>Informação de Localização</h1>
    <p>Por favor, forneça a sua informação de localização:</p>

  <form method="post" action="<?php echo site_url('cart/save_location'); ?>">
    <label for="city">Cidade:</label>
    <input type="text" name="city" id="city" value="<?php echo isset($city) ? $city : ''; ?>" required autocomplete="off"><br><br>

<label for="address">Endereço:</label>
<input type="text" name="address" id="address" value="<?php echo isset($address) ? $address : ''; ?>" autocomplete="off"><br><br>

<label for="country">País:</label>
<input type="text" name="country" id="country" value="<?php echo isset($country) ? $country : ''; ?>" required autocomplete="off"><br><br>

<label for="phone_number">Número de Telefone:</label>
<input type="text" name="phone_number" id="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" autocomplete="off"><br><br>

<label for="postal_code">Código Postal:</label>
<input type="text" name="postal_code" id="postal_code" value="<?php echo isset($postal_code) ? $postal_code : ''; ?>" autocomplete="off"><br><br>


<input type="submit" value="Guardar">
  </form>
</body>
</html>