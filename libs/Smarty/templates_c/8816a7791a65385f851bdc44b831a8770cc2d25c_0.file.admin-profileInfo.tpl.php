<?php
/* Smarty version 3.1.33, created on 2024-10-24 12:32:45
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\admin-profileInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_671a224def1694_79984828',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8816a7791a65385f851bdc44b831a8770cc2d25c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\admin-profileInfo.tpl',
      1 => 1729765957,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_671a224def1694_79984828 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">Prenota</a></li>
            <li><a href="#services">Visualizza prenotazioni</a></li>
            <li class="dropdown"><a href="#"><span>Aggiornamenti</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Piste</a></li>
                <li><a href="#">Impianti</a></li>
                <li><a href="#">Web</a></li>
              </ul>
            </li>
            <li><a href="#contact">Profilo</a></li>
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
            <li><a href="/Slope">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
        <h1>Starter Page</h1>
      </div>
    </div> --><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 

      <div class="container" data-aos="fade-up">
        
        <div class="profile-container">
            <div class="profile-info">
                <form action="/Slope/User/confirmModify" enctype="multipart/form-data" method="POST">
                    <h2>MODIFICA PROFILO</h2>
                    <p><strong>Nome utente:</strong></p>
                    <input type="text" id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" required>

                    <p><strong>Nome:</strong></p>
                    <input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" required>

                    <p><strong>Cognome:</strong></p>
                    <input type="text" id="surname" name="surname" value="<?php echo $_smarty_tpl->tpl_vars['surname']->value;?>
" required>

                    <p><strong>Email di conferma:</strong></p>
                    <input type="email" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" required>

                    <p><strong>Numero di telefono:</strong></p>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $_smarty_tpl->tpl_vars['phoneNumber']->value;?>
" required>
                    <?php if ($_smarty_tpl->tpl_vars['phoneError']->value == true) {?>
                    <label>Inserire numero del tipo +39NUMERO_DI_TELEFONO</label>
                    <?php }?>

                    <p><strong>Data nascita:</strong></p>
                    <input type="date" id="birthDate" name="birthDate" min="1900-01-01" value="<?php echo $_smarty_tpl->tpl_vars['birthDate']->value;?>
" required>
                    <?php if ($_smarty_tpl->tpl_vars['dateError']->value == true) {?>
                    <label>Inserire una data compresa tra 01-01-1900 e oggi</label>
                    <?php }?>

                    <p><strong>Modifica immagine:</strong></p>
                    <input type="file" name="imageFile" id ="imageFile" multiple>
                    <?php if ($_smarty_tpl->tpl_vars['imageError']->value == true) {?>
                    <label>Errore nel caricamento dell'immagine. Riprovare!</label>
                    <?php }?>
                    <button class="edit-button" type="submit">Conferma modifiche</button>
                </form>
            </div>
            
            <p><strong>Modifica password:</strong></p>
            <div class="button-container">
              <a href="/Slope/User/modifyPassword"><button class="edit-button">Modifica password</button></a>
            </div>
            
            
        </div>

      <!-- Da riempire in base alla pagina  -->

      </div>

    </section><!-- /Starter Section Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about">
            <a href="/Slope" class="logo sitename">Day</a>
            <div class="footer-contact pt-3">
              <p>Via Vetoio</p>
              <p>L'Aquila, AQ 67100</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+39 123 456 7890</span></p>
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
