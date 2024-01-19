  <style>
    .register-container {
      max-width: 800px;
      margin: 80px auto 0;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: grid;
      grid-template-columns: 1fr 1fr;
      align-items: center;
    }

    .register-container h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .register-container .image-container {
      flex: 1;
    }

    .register-container .image-container img {
      width: 83%;
      height: auto;
    }

    .register-container .form-container {
      padding: 0 20px;
    }

    .register-container label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .register-container input[type="text"],
    .register-container input[type="password"],
    .register-container input[type="email"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .register-container button[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      
    }

    .register-container button[type="submit"]:hover {
      background-color: #555;
    }

    .register-container .additional-links {
      margin-top: 15px;
      text-align: center;
    }

    .register-container .additional-links a {
      color: #333;
      text-decoration: none;
      margin-right: 10px;
    }

    .register-container .additional-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="image-container">
      <img src="<?php echo base_url("assets/img/roupa3.jpg"); ?>"alt="Register Image">
    </div>
    <div class="form-container">
      <h1>Registo</h1>

      <?php echo validation_errors(); ?>

      <?php if ($this->session->flashdata('success')): ?>
        <div><?php echo $this->session->flashdata('success'); ?></div>
      <?php endif; ?>

      <?php echo form_open('auth/register'); ?>
      
      <div>
        <label>Nome</label>
        <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>">
      </div>
      <div>
        <label>Sobrenome</label>
        <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>">
      </div>
      <div>
        <label>Nome de Utilizador</label>
        <input type="text" name="username" value="<?php echo set_value('username'); ?>">
      </div>
      <div>
        <label>Palavra-passe</label>
        <input type="password" name="password">
      </div>
      <div>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo set_value('email'); ?>">
      </div>
      <div>
        <label>Número de Telefone</label>
        <input type="text" name="phone_number" value="<?php echo set_value('phone_number'); ?>">
      </div>

      <div>
        <button type="submit">Registar</button>
      </div>
      <?php echo form_close(); ?>

      <div class="additional-links">
        <a href="<?php echo site_url('auth/login'); ?>">Já tem uma conta? Faça login aqui.</a>
      </div>
    </div>
  </div>
</body>
</html>
