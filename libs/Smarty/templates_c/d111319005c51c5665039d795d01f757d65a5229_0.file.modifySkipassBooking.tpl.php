<?php
/* Smarty version 3.1.33, created on 2025-06-26 15:46:16
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\modifySkipassBooking.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_685d4f2817f7a6_31518667',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd111319005c51c5665039d795d01f757d65a5229' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\modifySkipassBooking.tpl',
      1 => 1750945574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685d4f2817f7a6_31518667 (Smarty_Internal_Template $_smarty_tpl) {
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
            <li><a href="/Slope/ManageBooking/showBookings">Visualizza Prenotazioni</a></li>
            <li><a href="/Slope/UserOperations/profile">Profile</a></li>
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

      <div class="container modifySkipassBooking" data-aos="fade-up">

        <div class="form-container">
          <h1>Modifica prenotazione</h1>
          <form action="/Slope/ManageBooking/confirmModifyBooking" method="post">
              <label for="name">Nome</label>
              <input type="text" id="name" name="name" value=<?php echo $_smarty_tpl->tpl_vars['skipassBooking']->value->getName();?>
 readonly>

              <label for="surname">Cognome</label>
              <input type="text" id="surname" name="surname" value=<?php echo $_smarty_tpl->tpl_vars['skipassBooking']->value->getSurname();?>
 readonly>

              <label for="email">Email di conferma</label>
              <input type="email" id="email" name="email" value=<?php echo $_smarty_tpl->tpl_vars['skipassBooking']->value->getEmail();?>
  readonly>

              <div class="durata-skipass">
                  <p>Durata skipass</p>
                  <?php if ($_smarty_tpl->tpl_vars['skipassBooking']->value->getPeriod() == 1) {?>
                  <label><input type="radio" name="period" value="giornaliero" checked readonly> Giornaliero</label>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['skipassBooking']->value->getPeriod() == 7) {?>
                  <label><input type="radio" name="period" value="settimanale" checked readonly> Settimanale</label>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['skipassBooking']->value->getPeriod() == 30) {?>
                  <label><input type="radio" name="period" value="mensile" checked readonly> Mensile</label>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['skipassBooking']->value->getPeriod() == 30*6) {?>
                  <label><input type="radio" name="period" value="stagionale" checked readonly> Stagionale</label>
                  <?php }?>
              </div>

              <div class="tipologia-biglietto">
                  <p>Tipologia biglietto</p>
                  <?php if ($_smarty_tpl->tpl_vars['skipassBooking']->value->getType() == 'intero') {?>
                  <label><input type="radio" name="type" value="intero" checked readonly> Intero</label>
                  <?php } else { ?>
                  <label><input type="radio" name="type" value="ridotto" checked readonly> Ridotto</label>
                  <?php }?>
              </div>

              <label for="data">Seleziona una data</label>
              <input type="date" id="date" name="date" min=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 value=<?php echo $_smarty_tpl->tpl_vars['skipassBooking']->value->getStartDate();?>
>
              <?php if ($_smarty_tpl->tpl_vars['dateWarning']->value) {?> 
              <label>Controllare se la data inserita è corretta. La data potrebbe essere troppo lontana da quella corrente.</label>
              <?php }?>

              <button type="submit">Conferma</button>
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
