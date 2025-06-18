<?php
/* Smarty version 3.1.33, created on 2025-05-28 17:10:14
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\subscriptionPaymentSection.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68372756262999_24507304',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab3f590b8ea32d9306c17f293b4a174f9439e395' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\subscriptionPaymentSection.tpl',
      1 => 1748445006,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68372756262999_24507304 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li><a href="/Slope/">Home</a></li>
            <li><a href="/Slope/User/showBookings">Visualizza Prenotazioni</a></li>
            <li><a href="/Slope/User/profile">Profile</a></li>
            <li><a href="/Slope/User/logout">LogOut</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <main class="main">

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 

      <div class="container subscriptionPaymentSection" data-aos="fade-up">

        <div class="payment-container">
        <h1>Riepilogo Pagamento</h1>
        
          <!-- Dettagli acquisto -->
          <div class="order-summary">
              <h2>Dettagli Acquisto</h2>
              <ul class="order-list">
                  <li>
                      <span>Abbonamento</span>
                      <span>€<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</span>
                  </li>
                  <li class="total">
                      <span><strong>Totale</strong></span>
                      <span><strong>€<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</strong></span>
                  </li>
              </ul>
          </div>
        
          <form action="/Slope/User/subscriptionPayment" class="payment-form"  enctype="multipart/form-data" method="POST">
            <h2>Paga con Carta di Credito</h2>
              <div class="form-group">
                  <label for="cardHolderName">Nome Intestatario Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-name" name="cardHolderName" placeholder="Mario" required>
                  <?php } else { ?>
                  <input type="text" id="card-name" name="cardHolderName" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardHolderName();?>
 required>
                  <?php }?>
              </div>
              <div class="form-group">
                  <label for="cardHolderSurname">Cognome Intestatario Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-surname" name="cardHolderSurname" placeholder="Rossi" required>
                  <?php } else { ?>
                  <input type="text" id="card-surname" name="cardHolderSurname" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardHolderSurname();?>
 required>
                  <?php }?>
              </div>
              <div class="form-group">
                  <label for="cardNumber">Numero Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-number" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"  required>
                  <?php } else { ?>
                  <input type="text" id="card-number" name="cardNumber" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardNumber();?>
 maxlength="19"  required>
                  <?php }?>
              </div>
              <div class="form-row">
                  <div class="form-group">
                      <label for="expiryDate">Scadenza Carta</label>
                      <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                      <input type="month" id="expiry-date" name="expiryDate" required>
                      <?php } else { ?>
                      <input type="month" id="expiry-date" name="expiryDate" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getExpiryDate();?>
 required>
                      <?php }?>
                  </div>
                  <div class="form-group">
                      <label for="cvv">CVV</label>
                      <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                      <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  required>
                      <?php } else { ?>
                      <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCvv();?>
 required>
                      <?php }?>
                  </div>
              </div>
              <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
              <div class="form-group">
                <label for="preferred">Salvare come metodo preferito</label>
                <input type="checkbox" id="preferred" name="preferred" >
              </div>
              <?php } else { ?> 
              <div class="form-group">
                <label for="preferred">Salvare come metodo preferito</label>
                <input type="checkbox" id="preferred" name="preferred" checked>
              </div>
              <?php }?>
              
              <button type="submit" class="submit-btn">Procedi al Pagamento</button>
          </form>

        </div>

      </div>

    </section><!-- /Starter Section Section -->

  </main>


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
