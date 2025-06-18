<?php
/* Smarty version 3.1.33, created on 2025-06-02 13:06:06
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\admin-searchSkipassBooking.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_683d859ec6be59_88522198',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f21478e97ac11ca09b472b3ff38a0d9c53d63e6a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\admin-searchSkipassBooking.tpl',
      1 => 1748862364,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683d859ec6be59_88522198 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Seleziona prenotazione skipass</title>

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

  <header id="header-admin" class="header-admin sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/Slope" class="logo d-flex align-items-center">
          <h1 class="sitename">Slope Admin</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/Slope/Admin/dashboard">Dashboard</a></li>
            <li><a href="/Slope/Admin/logout">LogOut</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <main class="main">

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 

      <div class="container" data-aos="fade-up">
      
        <!-- Da riempire in base alla pagina  -->
      <div class="form-container searchSkipassBooking">
        <div class="admin-filter-container">
          <h2>Filtra prenotazioni</h2>
          <div class="filters">
            <form class="search-form" action="/Slope/Admin/searchSkipassBooking" method="POST">
              <input type="text" id="username" name="username" placeholder="Username">
              <input type="text" id="nameSkiFacility" name="nameSkiFacility" placeholder="Nome impianto">
              <input type="text" id="email" name="email" placeholder="Email attuale">
              <button type="submit">Filtra</button>
            </form>
          </div>
        </div>

        <?php if (count($_smarty_tpl->tpl_vars['objects']->value) > 0) {?>
          <div class="users">
            <div class="cards-container">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['objects']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
              <div class="card">
                <div class="skippass-info">
                    <p>Utente: <?php echo $_smarty_tpl->tpl_vars['i']->value[2]->getUsername();?>
</p>
                    <p>Nome: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getName();?>
</p>
                    <p>Cognome: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getSurname();?>
</p>
                    <p>Tipologia: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getType();?>
</p>
                    <p>Data: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getStartDate();?>
</p>
                    <p>Email: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getEmail();?>
</p>
                    <p>Prezzo: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getValue();?>
</p>
                    <p>Durata: <?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getPeriod();?>
</p>
                    <p>Impianto: <?php echo $_smarty_tpl->tpl_vars['i']->value[1]->getName();?>
</p>
                </div>
                <div class="action-buttons">
                  <form action="/Slope/Admin/modifySkipassBooking" method="POST">
                    <button type="submit" name="idSkipassBooking" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getIdSkipassBooking();?>
 class="edit">Modifica</button>
                  </form>
                  <form action="/Slope/Admin/deleteSkipassBooking" method="POST">
                    <button type="submit" name="idSkipassBooking" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[0]->getIdSkipassBooking();?>
 class="delete">Elimina</button>
                  </form>
                </div>
              </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
          </div>
        <?php }?>
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
