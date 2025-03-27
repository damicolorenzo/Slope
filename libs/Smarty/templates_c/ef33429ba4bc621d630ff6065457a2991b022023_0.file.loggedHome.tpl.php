<?php
/* Smarty version 3.1.33, created on 2025-02-26 10:39:44
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\loggedHome.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_67bee160464da4_57813232',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef33429ba4bc621d630ff6065457a2991b022023' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\loggedHome.tpl',
      1 => 1740562445,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67bee160464da4_57813232 (Smarty_Internal_Template $_smarty_tpl) {
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
.card-impianto {
  display: flex;
  flex-direction: row;
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 450px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.impianto, .dettagli-impianto {
  padding: 16px;
  width: 50%;
}

.impianto {
  background-color: #f8f8f8;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.impianto h3 {
  font-size: 18px;
  color: #333;
  margin-bottom: 8px;
}

.impianto-img {
  width: 100%;
  border-radius: 4px;
  height: auto;
  max-height: 120px;
  object-fit: cover;
}

.dettagli-impianto h4 {
  margin-top: 0;
  font-size: 16px;
  color: #666;
}

.dettagli-impianto .piste {
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-bottom: 10px;
}

.pista {
  padding: 4px 8px;
  border-radius: 4px;
  color: #fff;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.pista.rossa {
  background-color: #e74c3c; /* Colore rosso per piste rosse */
}

.pista.nera {
  background-color: #2c3e50; /* Colore nero per piste nere */
}

.pista.blu {
  background-color: #3498db; /* Colore blu per piste blu */
}

.pista.verde {
  background-color: #2ecc71; /* Colore verde per piste verdi */
}

.dettagli-impianto p {
  margin: 4px 0;
  font-size: 14px;
  color: #444;
}

.dettagli-impianto span {
  font-weight: bold;
}

.status {
  padding: 4px 8px;
  border-radius: 4px;
  color: #fff;
  font-size: 12px;
}

.status.aperto {
  background-color: #4caf50; /* Verde per aperto */
}

.status.chiuso {
  background-color: #f44336; /* Rosso per chiuso */
}
.search-form {
  display: flex;

}</style>
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
      <div class="container" data-aos="fade-up">

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['map']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?> 
          <form class="search-form" action="/Slope/User/skiFacilityDetails" method="POST">
          <div class="card-impianto">
            <div class="impianto">
              <h3><?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
</h3>
              <img src="link-alla-tua-immagine.jpg" alt="Immagine dell'impianto" class="impianto-img">
            </div>
            <div class="dettagli-impianto">
              <h4>Dettagli <?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
</h4> 
              <button type="submit" name="nameSkiFacility" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
 >Esplora</button>
                <div class="piste">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['i']->value[1], 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value) {
?>  
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['type'] == 'blu') {?>
                    <div class="pista blu">Blu: <span><?php echo $_smarty_tpl->tpl_vars['e']->value['CNT'];?>
</span></div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['type'] == 'rossa') {?>
                    <div class="pista rossa">Rosse: <span><?php echo $_smarty_tpl->tpl_vars['e']->value['CNT'];?>
</span></div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['type'] == 'nera') {?>
                    <div class="pista nera">Nere: <span><?php echo $_smarty_tpl->tpl_vars['e']->value['CNT'];?>
</span></div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['type'] == 'verde') {?>
                    <div class="pista verde">Verdi: <span><?php echo $_smarty_tpl->tpl_vars['e']->value['CNT'];?>
</span></div>
                    <?php }?>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
                <p>Impianti: <span><?php echo $_smarty_tpl->tpl_vars['i']->value[2];?>
</span></p>
                <p>Status: <span class="status aperto">'aperto'</span></p>
            </div>
            
          </div>
          
          <form>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

      </div>

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
