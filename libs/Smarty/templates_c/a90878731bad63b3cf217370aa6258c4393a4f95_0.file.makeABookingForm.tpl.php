<?php
/* Smarty version 3.1.33, created on 2025-06-27 10:20:36
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\makeABookingForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_685e5454b637f3_59049296',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a90878731bad63b3cf217370aa6258c4393a4f95' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\makeABookingForm.tpl',
      1 => 1751012434,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685e5454b637f3_59049296 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Prenota</title>

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

      <div class="container makeABookingForm" data-aos="fade-up">
        <?php if (count($_smarty_tpl->tpl_vars['map']->value) > 0 && $_smarty_tpl->tpl_vars['status']->value) {?>
        <div class="form-container">
          <h1>Form di prenotazione</h1>
            <form action="/Slope/ManageBooking/confirmBooking" method="post">
              <input type="hidden" id="idSkiFacility" name="idSkiFacility" value=<?php echo $_smarty_tpl->tpl_vars['idSkiFacility']->value;?>
>
              <label for="name">Nome</label>
              <input type="text" id="name" name="name" value=<?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>
 required>

              <label for="surname">Cognome</label>
              <input type="text" id="surname" name="surname" value=<?php echo $_smarty_tpl->tpl_vars['user']->value->getSurname();?>
 required> 

              <label for="email">Email di conferma</label>
              <input type="email" id="email" name="email" value=<?php echo $_smarty_tpl->tpl_vars['user']->value->getEmail();?>
 required>
              
              

              <div class="durata-skipass">
                  <p>Durata skipass</p>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['map']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                      <?php $_smarty_tpl->_assignInScope('giorni', $_smarty_tpl->tpl_vars['i']->value[0]);?>
                      <?php $_smarty_tpl->_assignInScope('tipo', $_smarty_tpl->tpl_vars['i']->value[1]);?>
                      <label>
                          <input type="radio" name="period" value="<?php echo $_smarty_tpl->tpl_vars['giorni']->value;?>
|<?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>
" required>
                          <?php if ($_smarty_tpl->tpl_vars['giorni']->value == 1) {?>
                              <?php echo $_smarty_tpl->tpl_vars['giorni']->value;?>
 giorno - <?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>

                          <?php } else { ?>
                              <?php echo $_smarty_tpl->tpl_vars['giorni']->value;?>
 giorni - <?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>

                          <?php }?>
                      </label>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              

              <div class="acquista-assicurazione">
                  <label><input type="checkbox" name="insurance" checked> Acquista assicurazione</label>
              </div>

              <label for="data">Seleziona una data</label>
              <input type="date" id="date" name="date" min=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 value=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>
              <?php if ($_smarty_tpl->tpl_vars['dateWarning']->value) {?> 
              <label>Controllare se la data inserita è corretta. La data potrebbe essere troppo lontana da quella corrente oppure fuori dalla stagione (ottobre-marzo).</label>
              <?php }?>

              <button type="submit">Conferma</button>
              <?php if ($_smarty_tpl->tpl_vars['exist']->value) {?> 
              <label>ERRORE: una prenotazione identica già esiste nel database</label>
              <?php }?>
            </form>
        </div> 
      <?php } else { ?>
        <h1>Impossibile al momento prenotare uno skipass per questo impianto</h1>
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

</html><?php }
}
