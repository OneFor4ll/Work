<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=BenchNine:wght@300&display=swap" rel="stylesheet">
  <title>Ligne d'Or</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>

  *{
      font-family: 'BenchNine', sans-serif;
      padding:0;
      margin:0;
    }
    
    header {
      background-color: #333;
      color: white;
      padding: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo {
      font-size: 2em;
      font-weight: bold;
      text-decoration: none;
      color: white;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    /* Dropdown menu */
    .dropdown {
      position: relative;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: -30px;
      z-index: 1;
      background-color: black;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    .dropdown-menu li {
      padding: 5px;
    }

    .dropdown-menu li:hover {
      background-color: gray;
    }


    nav {
      margin-left: auto;
    }
    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: flex-end;
    }
    nav li {
      margin: 0 10px;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }
    
    .ball-container {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .ball {
      height: 20px;
      width: 20px;
      border-radius: 50%;
      background-color: #333;
      margin: 0 10px;
      cursor: pointer;
    }
    .ball.active {
      background-color: gray;
    }
    main {
      max-width: 100%;
      justify-content: center;
    }
    dialog{
      margin:auto;
      padding:1em;
    }
  </style>
</head>
<body>
<header>
  <a href="<?= base_url() ?>" class="logo">Ligne d'Or</a>
  <nav>
    <ul>
      <?php if ($this->session->userdata('role') == 'user') { ?>
      <!-- Header for user -->
      <li class="dropdown">
        <a>
          <i class="fas fa-user"></i> 
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?= site_url('address') ?>">Localização</a></li>
          <li><a href="<?= site_url('logout') ?>">Terminar sessão</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= site_url('cart/view') ?>">
          <i class="fas fa-shopping-cart"></i>
          <span id="cartCount"><?php echo isset($cartCount) ? $cartCount : 0; ?></span>
        </a>
      </li>
      <?php } elseif ($this->session->userdata('role') == 'seller') { ?>
      <!-- Header for seller -->
      <li class="dropdown">
        <a>
          <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?= site_url('products') ?>">Produtos</a></li>
          <li><a href="<?= site_url('address') ?>">Localização</a></li>
          <li><a href="<?= site_url('logout') ?>">Terminar sessão</a></li>
        </ul>
      </li>
      <li>
        <a href="<?= site_url('cart/view') ?>">
          <i class="fas fa-shopping-cart"></i>
          <span id="cartCount"><?php echo isset($cartCount) ? $cartCount : 0; ?></span>
        </a>
      </li>
      <!-- <?php } elseif ($this->session->userdata('role') == 'admin') { ?> -->
      <!-- Header for admin -->
      <li class="dropdown">
        <a>
          <i class="fas fa-user"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?= site_url('admin/users') ?>">Utilizadores</a></li>
          <li><a href="<?= site_url('products') ?>">Produtos</a></li>
          <li><a href="<?= site_url('address') ?>">Localização</a></li>
          <li><a href="<?= site_url('logout') ?>">Terminar sessão</a></li>
        </ul>
      </li>
      <li>
          <a href="<?= site_url('cart/view') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span id="cartCount"><?php echo isset($cartCount) ? $cartCount : 0; ?></span>
          </a>
      </li>
      <?php } else { ?>
      <!-- Header for guests -->
      <li><a href="<?= site_url('login') ?>">Login</a></li>
      <?php } ?>
    </ul>
  </nav>
</header>
<body>
  