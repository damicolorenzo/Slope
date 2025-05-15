<?php
/* Smarty version 3.1.33, created on 2025-05-13 15:49:59
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\skiRunsAndLiftsDetails.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68234e07c8c513_20444975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e419d4510153349caab5acdf4de8e6810219798' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\skiRunsAndLiftsDetails.tpl',
      1 => 1747144148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68234e07c8c513_20444975 (Smarty_Internal_Template $_smarty_tpl) {
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
.cards-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
}

.cards-container table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;  
  border-radius: 8px;
  overflow: hidden;
  font-family: Arial, sans-serif;
  background-color: #fff;
}

.cards-container th {
  background-color: #4682B4;
  color: white;
  text-align: left;
  padding: 12px 16px;
  font-size: 16px;
}

.cards-container td {
  padding: 12px 16px;
  border-bottom: 1px solid #eee;
  font-size: 14px;
  color: #333;
}

.cards-container tr:hover {
  background-color: #f0f8ff;
}

.cards-container td:nth-child(3), /* Stato */
.cards-container td:nth-child(4) {
  font-weight: bold;
}

.btn-submit {
  display: block;
  width: 50%;
  padding: 12px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  background-color: #4682B4;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 40px;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color: #FF7F50;
}

.aperto {
  background-color: #4caf50
}

.chiuso {
  background-color: #e74c3c
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
    
      <div  data-aos="fade-up">
        <div class="cards-container">
          <h3><?php echo $_smarty_tpl->tpl_vars['nameSkiFacility']->value;?>
</h3>

          <!-- Tabella piste da sci -->
          <table>
            <tr>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Stato</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['skiRuns']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value->getName();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
</td>
                <?php if ($_smarty_tpl->tpl_vars['i']->value->getStatus() == 'chiuso') {?>
                <td class="chiuso"><?php echo $_smarty_tpl->tpl_vars['i']->value->getStatus();?>
</td>
                <?php } else { ?>
                <td class="aperto"><?php echo $_smarty_tpl->tpl_vars['i']->value->getStatus();?>
</td>
                <?php }?>
              </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>

          <!-- Tabella impianti di risalita -->
          <table>
            <tr>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Stato</th>
              <th>Posti</th>
            </tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liftStructures']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value->getName();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
</td>
                <?php if ($_smarty_tpl->tpl_vars['i']->value->getStatus() == 'chiuso') {?>
                <td class="chiuso"><?php echo $_smarty_tpl->tpl_vars['i']->value->getStatus();?>
</td>
                <?php } else { ?>
                <td class="aperto"><?php echo $_smarty_tpl->tpl_vars['i']->value->getStatus();?>
</td>
                <?php }?>
                <td><?php echo $_smarty_tpl->tpl_vars['i']->value->getSeats();?>
</td>
              </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>

          <div class="action-buttons">
            <form class="search-form" action="/Slope/User/makeABookingPage" method="POST">
              <input type="hidden" id="idSkiFacility" name="idSkiFacility" value="<?php echo $_smarty_tpl->tpl_vars['idSkiFacility']->value;?>
">
              <button type="submit" class="btn-submit">Prenota</button>
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
