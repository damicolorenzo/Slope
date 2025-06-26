<?php
/* Smarty version 3.1.33, created on 2025-06-25 18:49:20
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\showBookings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_685c2890c180f7_58839419',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9646e996eb883e163a0100bddfc26918112a740' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\showBookings.tpl',
      1 => 1750870137,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685c2890c180f7_58839419 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Visualizza prenotazioni</title>

  <!-- Favicons -->
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: dark)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: dark)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: dark)">

  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/dark/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: light)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: light)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: light)">
  
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

      <div class="container showBookings" data-aos="fade-up">
        <?php if (count($_smarty_tpl->tpl_vars['bookings']->value) > 0) {?>
        <h1>Dati prenotazione</h1>
        <div class="card-booking-wrapper">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bookings']->value, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value) {
?>
            <div class="booking-card" id="booking-<?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getIdSkipassBooking();?>
">
              <p><strong>Nome:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getName();?>
</p>
              <p><strong>Cognome:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getSurname();?>
</p>
              <p><strong>Email:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getEmail();?>
</p>
              <p><strong>Data:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getStartDate();?>
</p>
              <?php if ($_smarty_tpl->tpl_vars['e']->value[0]->getPeriod() >= 1) {?>
              <p><strong>Periodo:</strong> <?php echo (int)$_smarty_tpl->tpl_vars['e']->value[0]->getPeriod();?>
 giorno</p> 
              <?php } else { ?>
              <p><strong>Periodo:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getPeriod();?>
 giorni</p> 
              <?php }?>
              <p><strong>Tipo:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getType();?>
</p>
              <p><strong>Prezzo totale:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getValue();?>
 euro</p>
              <p><strong>Impianto sci:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[1]->getName();?>
</p>
            
              <?php if ($_smarty_tpl->tpl_vars['e']->value[2] != array()) {?>
                <p><strong>Assicurazione:</strong></p>
                <img class="imagePreview" src="https://localhost/Slope/libs/Smarty/images/checked.png">
              <?php } else { ?>
                <div class="flex">
                  <p><strong>Assicurazione:</strong></p>
                  <form action="/Slope/PurchaseInsurance/buyInsurance" method="POST">
                    <input type="hidden" name="idSkipassBooking" value="<?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getIdSkipassBooking();?>
">
                    <button type="submit" class="btn-insurance">Acquista</button>
                  </form>
                </div>
              <?php }?>

              <div class="booking-actions">
                <form action="/Slope/ManageBooking/modifySkipassBooking" method="POST">
                  <input type="hidden" name="idSkipassBooking" value="<?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getIdSkipassBooking();?>
">
                  <button type="submit" class="btn-mod">Modifica</button>
                </form>

                <form action="/Slope/ManageBooking/deleteSkipassBooking" method="POST">
                  <input type="hidden" name="idSkipassBooking" value="<?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getIdSkipassBooking();?>
">
                  <button type="submit" class="btn-er">Elimina</button>
                </form>
              </div>
            </div>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php if (count($_smarty_tpl->tpl_vars['oldBookings']->value) > 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['oldBookings']->value, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value) {
?>
            <h2>Prenotazioni scadute</h2>
            <div class="booking-card" id="booking-<?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getIdSkipassBooking();?>
">
              <p><strong>Nome:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getName();?>
</p>
              <p><strong>Cognome:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getSurname();?>
</p>
              <p><strong>Email:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getEmail();?>
</p>
              <p><strong>Data:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getStartDate();?>
</p>
              
              <p><strong>Tipo:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getType();?>
</p>
              <p><strong>Prezzo totale:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[0]->getValue();?>
</p>
              <p><strong>Impianto sci:</strong> <?php echo $_smarty_tpl->tpl_vars['e']->value[1]->getName();?>
</p>
            </div>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php }?>
        </div>
      <?php } else { ?>
        <p>Non hai ancora prenotato nulla. Vuoi dare un’occhiata alle strutture disponibili?</p>
        <a href="/Slope/" class="btn btn-primary">Vai alla ricerca</a>
      <?php }?>
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

</html>
<?php }
}
