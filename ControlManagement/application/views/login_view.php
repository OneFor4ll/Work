<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Início de Sessão</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
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
    </style>
</head>
<body>
    <form method="post" action="<?php echo site_url('login/process_login'); ?>">
    <?php
    if ($this->session->flashdata('error')) {
        echo '<div class="warning-box">';
        echo '<p>' . $this->session->flashdata('error') . ' <i class="fas fa-exclamation-triangle"></i></p>';
        echo '</div>';
    }
    ?>
        <label for="username">Utilizador:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Palavra-passe:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Iniciar Sessão</button>

        <p>Não tem uma conta? <a href="<?php echo site_url('register'); ?>">Registe-se aqui</a></p>
    </form>
</body>
</html>
