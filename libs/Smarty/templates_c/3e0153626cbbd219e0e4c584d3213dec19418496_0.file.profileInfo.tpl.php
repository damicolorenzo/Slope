<?php
/* Smarty version 3.1.33, created on 2024-12-28 10:59:35
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\profileInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_676fcc0788f1a3_51340124',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e0153626cbbd219e0e4c584d3213dec19418496' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\profileInfo.tpl',
      1 => 1735378308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_676fcc0788f1a3_51340124 (Smarty_Internal_Template $_smarty_tpl) {
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
  .profile-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 40px; /* Aumentato lo spazio sotto */
  }

  .profile-info {
    width: 60%;
  }

  .profile-info h2 {
    margin-bottom: 20px; /* Più spazio sotto il titolo */
    font-size: 26px; /* Aumentata la dimensione del titolo */
  }

  .profile-info p {
    margin-bottom: 15px; /* Aumentato lo spazio tra le informazioni */
    font-size: 18px; /* Aumentata la dimensione del testo delle informazioni */
  }

  .profile-image {
    width: 30%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .profile-pic {
    width: 140px; /* Aumentata la dimensione dell'immagine del profilo */
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #000;
  }

  .section-container {
    height:auto;
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px; /* Aumentato lo spazio sotto le sezioni */
  }

  .profile-section {
    width: 48%;
    height:auto;  
    padding: 20px; /* Aumentato lo spazio interno delle sezioni */
    border: 2px solid #000;
    border-radius: 10px;
    background-color: #fff;
  }

  .profile-section h3 {
    margin-bottom: 20px; /* Più spazio sotto il titolo della sezione */
    font-size: 22px; /* Aumentata la dimensione del titolo della sezione */
  }

  .section-image {
    width: 100%;
    height: auto;
    height: 150px; /* Aumentata l'altezza delle immagini nelle sezioni */
    object-fit: cover;
    background-color: #ddd;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
  }

  .button-container {
    display: flex;
    justify-content: center;
    margin-top: 40px; /* Aggiunto più spazio sopra il pulsante */
  }

  .edit-button {
    padding: 15px 30px; /* Aumentata la dimensione del pulsante */
    font-size: 18px; /* Aumentata la dimensione del testo del pulsante */
    border: 2px solid #000;
    border-radius: 5px;
    background-color: #fff;
    cursor: pointer;
  }

  .edit-button:hover {
    background-color: #ddd;
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
                <?php if ($_smarty_tpl->tpl_vars['image']->value == 0) {?> 
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

        <div class="section-container">
            <div class="profile-section">
                <h3>ABBONAMENTO</h3>
                <!-- Immagine dell'abbonamento -->
                <?php if ($_smarty_tpl->tpl_vars['subscriptionImage']->value === false) {?>
                <img src="https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="Immagine abbonamento" class="section-image">
                <?php }?>
                <div class="button-container">
                    <a href="/Slope/User/buySubscription"><button class="edit-button">Acquista</button></a>
                </div>
            </div>
        </div>

        <div class="button-container">
            <a href="/Slope/User/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
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
