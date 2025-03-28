<?php
/* Smarty version 3.1.33, created on 2024-11-30 15:49:25
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\registration.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_674b25f56b0f21_32402803',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '028bf6a8f3606be519b25ff0001000f2eeb73dad' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\registration.tpl',
      1 => 1732977992,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_674b25f56b0f21_32402803 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Registration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/favicon.png" rel="icon">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://localhost/Slope/libs/Smarty/day/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="https://localhost/Slope/libs/Smarty/day/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Day
  * Template URL: https://bootstrapmade.com/day-multipurpose-html-template-for-free/
  * Updated: Jun 14 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
  .form_login-container {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 45%;
}

.form_login-container form h2 {
  margin-bottom: 20px;
  color: #333;
}

.form_login-container label {
  display: block;
  margin-bottom: 8px;
  color: #666;
}

.form_login-container input[type="text"],
input[type="password"],
input[type="email"],
input[type="username"], 
input[type="tel"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

input[type="date"] {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 16px;
  font-family: Arial, sans-serif;
}

input[type="date"]:focus {
  border-color: #4CAF50;
  outline: none;
}

input[type="date"]::-webkit-calendar-picker-indicator {
  background: url('data:image/svg+xml;base64,<svg>...</svg>') no-repeat center;
  cursor: pointer;
  color: transparent; 
  opacity: 0.5; 
}

input[type="date"]::placeholder {
  color: #999;
  font-style: italic;
}

.form_login-container button {
  width: 100%;
  padding: 10px;
  background-color: #007BFF;
  border: none;
  border-radius: 4px;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.form_login-container button:hover {
  background-color: #0056b3;
}
  </style>
</head>

<body class="starter-page-page">

  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/Slope" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Slope</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <!-- <li><a href="#hero">Home</a></li>
            <li><a href="#about">Prenota</a></li>
            <li><a href="#services">Visualizza prenotazioni</a></li>
            <li class="dropdown"><a href="#"><span>Aggiornamenti</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a> -->
              <ul>
                <!-- <li><a href="#">Piste</a></li>
                <li><a href="#">Impianti</a></li>
                <li><a href="#">Web</a></li> -->
              </ul>
            </li>
            <li><a href="/Slope/">Home</a></li>
            <li><a href="/Slope/User/login">Login</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <main class="main">

    <!-- Page Title -->
    <!-- <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
        <h1>Starter Page</h1>
      </div>
    </div> --><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 
      <?php if ($_smarty_tpl->tpl_vars['exist']->value == false) {?>
      <div class="container" data-aos="fade-up">
        <div class="form_login-container">
            <form class="register-form" action="/Slope/User/checkRegistration" method="POST">
                <h2>Registrazione</h2>
                
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" required>
                
                <label for="surname">Cognome</label>
                <input type="text" id="surname" name="surname" value="<?php echo $_smarty_tpl->tpl_vars['surname']->value;?>
" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" required>
                
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" required>
                
                <label for="phoneNumber">Numero di telefono</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $_smarty_tpl->tpl_vars['phoneNumber']->value;?>
" required>
                <?php if ($_smarty_tpl->tpl_vars['phoneError']->value == true) {?>
                <label>Inserire numero del tipo +39NUMERO_DI_TELEFONO</label>
                <?php }?>
                
                <label for="birthDate">Data di nascita</label>
                <input type="date" id="birthDate" name="birthDate" min="1900-01-01" value="<?php echo $_smarty_tpl->tpl_vars['birthDate']->value;?>
" required>
                <?php if ($_smarty_tpl->tpl_vars['dateError']->value == true) {?>
                <label>Inserire una data compresa tra 01-01-1900 e oggi</label>
                <?php }?>

                <label for="password-register">Password</label>
                <input type="password" id="password" name="password" required>
                <?php if ($_smarty_tpl->tpl_vars['passwordError']->value == true) {?>
                <label>Lunghezza minima 8 CARATTERI, lettere maiuscole/minuscole, numeri, almeno un carattere speciale</label>
                <?php }?>
                
                <button type="submit">Registrati</button>
            </form>
        </div>
      </div>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['exist']->value == true) {?>
      <div class="container" data-aos="fade-up">
        <h1>L'utente è già presente nel database</h1>
        <h2>Effettua l'accesso <a href="/Slope/User/login">qui</a></h2>
      </div>
      <?php }?>

    </section><!-- /Starter Section Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about">
            <a href="/Slope" class="logo sitename">Slope</a>
            <div class="footer-contact pt-3">
              <p>Via Vetoio</p>
              <p>L'Aquila, AQ 67100</p>
              <p class="mt-3"><strong>Numero:</strong> <span>+39 123 456 7890</span></p>
              <p><strong>Email:</strong> <span>info@example.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Slope</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/php-email-form/validate.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/aos/aos.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/glightbox/js/glightbox.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/vendor/isotope-layout/isotope.pkgd.min.js"><?php echo '</script'; ?>
>

  <!-- Main JS File -->
  <?php echo '<script'; ?>
 src="https://localhost/Slope/libs/Smarty/day/assets/js/main.js"><?php echo '</script'; ?>
>

</body>

</html><?php }
}
