<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Registo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .error-messages {
            background-color: #ff3333;
            color: #fff;
            border: 1px solid #ff0000;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .error-messages p {
            margin: 0;
            padding: 5px 10px;
        }
        .registration-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .warning {
            color: #ff3333;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .warning-box {
            background-color: #ff3333;
            color: #fff;
            border: 1px solid #ff0000;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
        }
        .warning-box p {
            margin: 0;
            padding: 5px 10px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Registo</h2>


    <div class="registration-form">
        <form method="post" action="<?php echo site_url('register/process_registration'); ?>">

        <?php
if ($this->session->flashdata('custom_errors')) {
    $errorMessages = $this->session->flashdata('custom_errors');
    if (!empty($errorMessages)) {
        echo '<div class="warning-box">';
        echo '<p>Verifique os erros <i class="fas fa-exclamation-triangle"></i></p>'; 
        echo '</div>';
    }
}
?>    
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" required>
            <?php
            if (isset($errorMessages['name'])) {
                echo '<div class="warning">' . $errorMessages['name'] . '</div>';
            }
            ?>

            <label for="nif">NIF:</label>
            <input type="text" name="nif" id="nif" required>
            <?php
            if (isset($errorMessages['nif'])) {
                echo '<div class="warning">' . $errorMessages['nif'] . '</div>';
            }
            ?>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <?php
            if (isset($errorMessages['email'])) {
                echo '<div class="warning">' . $errorMessages['email'] . '</div>';
            }
            ?>

            <label for="phone">Telefone:</label>
            <input type="text" name="phone" id="phone">
            <?php
            if (isset($errorMessages['phone'])) {
                echo '<div class="warning">' . $errorMessages['phone'] . '</div>';
            }
            ?>

            <label for="address">Morada:</label>
            <input type="text" name="address" id="address">
            <?php
            if (isset($errorMessages['address'])) {
                echo '<div class="warning">' . $errorMessages['address'] . '</div>';
            }
            ?>

            <label for="manager_name">Nome do Gestor:</label>
            <input type="text" name="manager_name" id="manager_name">
            <?php
            if (isset($errorMessages['manager_name'])) {
                echo '<div class="warning">' . $errorMessages['manager_name'] . '</div>';
            }
            ?>

            <label for="username">Utilizador:</label>
            <input type="text" name="username" id="username" required>
            <?php
            if (isset($errorMessages['username'])) {
                echo '<div class="warning">' . $errorMessages['username'] . '</div>';
            }
            ?>

            <label for="password">Palavra-passe:</label>
            <input type="password" name="password" id="password" required>
            <?php
            if (isset($errorMessages['password'])) {
                echo '<div class="warning">' . $errorMessages['password'] . '</div>';
            }
            ?>

            <button type="submit">Registar</button>
            <p>Já tem uma conta? <a href="<?php echo site_url('login'); ?>">Início de Sessão</a></p>
        </form>
    </div>
</body>
</html>
