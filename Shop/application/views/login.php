<style>
  body {
    margin: 0;
    padding: 0;
  }

  .login-container {
    max-width: 800px;
    margin: 80px auto 0; /* Added top margin */
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
  }

  .image-container {
    flex: 1;
  }

  .image-container img {
    width: 83%;
    height: auto;
  }

  .form-container {
    padding: 0 20px;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
  }

  .error {
    color: red;
    margin-bottom: 10px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="password"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  button[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }

  button[type="submit"]:hover {
    background-color: #555;
  }

  .additional-links {
    margin-top: 15px;
    text-align: center;
  }

  .additional-links a {
    color: #333;
    text-decoration: none;
    margin-right: 10px;
  }

  .additional-links a:hover {
    text-decoration: underline;
  }
</style>


<div class="login-container">
  <div class="image-container">
    <img src="<?php echo base_url("assets/img/roupa4.jpg"); ?>" alt="Login Image">
  </div>
  <div class="form-container">
    <h1>Login</h1>

    <?php echo validation_errors(); ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="error"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?php echo form_open('auth/login'); ?>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
      </div>
      <div class="form-group">
        <button type="submit">Login</button>
      </div>
    <?php echo form_close(); ?>

    <div class="additional-links">
      <a href="<?php echo site_url('auth/register'); ?>">Ainda não tem conta?</a><br/>
      <a href="<?php echo site_url(''); ?>">Esqueceu a sua senha?</a>
    </div>
  </div>
</div>
