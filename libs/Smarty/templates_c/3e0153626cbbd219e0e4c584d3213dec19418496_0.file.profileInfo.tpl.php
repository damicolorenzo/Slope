<?php
/* Smarty version 3.1.33, created on 2025-06-24 16:00:12
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\profileInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_685aaf6ce72a93_28862615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e0153626cbbd219e0e4c584d3213dec19418496' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\profileInfo.tpl',
      1 => 1750773558,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685aaf6ce72a93_28862615 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profilo</title>

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

      <div class="container profileInfo" data-aos="fade-up">
        
        <div class="profile-container">
          <div class="profile-info">
              <h2>INFORMAZIONI PROFILO</h2>
              <p><strong>Nome utente:</strong> <?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</p>
              <p><strong>Nome:</strong> <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</p>
              <p><strong>Cognome:</strong> <?php echo $_smarty_tpl->tpl_vars['surname']->value;?>
</p>
              <p><strong>Email di conferma:</strong> <?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</p>
              <p><strong>Numero di telefono:</strong> <?php echo $_smarty_tpl->tpl_vars['phoneNumber']->value;?>
</p>
              <p><strong>Data nascita:</strong> <?php echo $_smarty_tpl->tpl_vars['birthDate']->value;?>
</p>
          </div>
          <div class="profile-image">
              <!-- Immagine del profilo -->
              <?php if ($_smarty_tpl->tpl_vars['image']->value == array()) {?> 
                <img class="profile-pic" src="https://localhost/Slope/libs/Smarty/images/NotFound.jpg" loading="lazy" alt="Img">
              <?php } else { ?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                <img class="profile-pic" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" loading="lazy" alt="Img">
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <?php }?>
          </div>
        </div>
        <div class="button-container">
            <a href="/Slope/UserOperations/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
        </div>
        <?php if (count($_smarty_tpl->tpl_vars['creditCard']->value) > 0) {?>
        <div class="creditCard">
          <h2>Metodo di Pagamento</h2>
          <div class="card-details">
            <p><strong>Nome:</strong> <?php echo $_smarty_tpl->tpl_vars['creditCard']->value[0]->getCardHolderName();?>
</p>
            <p><strong>Cognome:</strong> <?php echo $_smarty_tpl->tpl_vars['creditCard']->value[0]->getCardHolderSurname();?>
</p>
            <p><strong>Numero Carta:</strong> **** **** **** <?php echo substr($_smarty_tpl->tpl_vars['creditCard']->value[0]->getCardNumber(),-4);?>
</p>
            <p><strong>Scadenza:</strong> <?php echo $_smarty_tpl->tpl_vars['creditCard']->value[0]->getExpiryDate();?>
</p>
            <p><strong>CVV:</strong> ***</p>
          </div>
          <div class="card-actions">
            <form action="/Slope/UserOperations/modifyCreditCard" class="modifyCreditCard"  enctype="multipart/form-data" method="POST">
            <button type=submit class="btn edit">Modifica</button>
            </form>
            <form action="/Slope/UserOperations/deleteCreditCard" class="deleteCreditCard"  enctype="multipart/form-data" method="POST">
            <button class="btn remove">Rimuovi Carta</button>
            </form>
          </div>
        </div>
        <?php }?>
        <?php if (count($_smarty_tpl->tpl_vars['subscription']->value) > 0) {?>
        <?php if ($_smarty_tpl->tpl_vars['rebuySub']->value) {?>
        <div class="subscription-box">
          <h2>Abbonamento</h2>
          <p>Data inizio: <?php echo $_smarty_tpl->tpl_vars['subscription']->value[0]->getStartDate();?>
</p>
          <p>Data fine: <?php echo $_smarty_tpl->tpl_vars['subscription']->value[0]->getEndDate();?>
</p>
          <div class="button-container">
            <a href="/Slope/PurchaseSubscription/rebuySubscription"><button class="edit-button">Acquista nuovamente</button></a>
          </div>
        </div>
        <?php } else { ?>
        <div class="subscription-box">
          <h2>Abbonamento</h2>
          <p>Data inizio: <?php echo $_smarty_tpl->tpl_vars['subscription']->value[0]->getStartDate();?>
</p>
          <p>Data fine: <?php echo $_smarty_tpl->tpl_vars['subscription']->value[0]->getEndDate();?>
</p>
        </div>
        <?php }?>
        <?php }?>
        <?php if (count($_smarty_tpl->tpl_vars['subscription']->value) <= 0) {?>
        <div class="button-container">
            <a href="/Slope/PurchaseSubscription/buySubscription"><button class="super-button">Acquista abbonamento</button></a>
        </div>
        <?php }?>

      <!-- Da riempire in base alla pagina  -->

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
