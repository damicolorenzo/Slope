<?php
/* Smarty version 3.1.33, created on 2025-05-15 14:15:39
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\profileInfo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6825daeb96d1a8_97033222',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e0153626cbbd219e0e4c584d3213dec19418496' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\profileInfo.tpl',
      1 => 1747239937,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6825daeb96d1a8_97033222 (Smarty_Internal_Template $_smarty_tpl) {
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
  /* Layout container principale */
.profile-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #f9f9f9;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    flex-wrap: wrap;
}

/* Info profilo */
.profile-info {
    flex: 1;
    min-width: 300px;
    padding-right: 20px;
}

.profile-info h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 24px;
    border-bottom: 2px solid #4682B4;
    padding-bottom: 5px;
}

.profile-info p {
    font-size: 16px;
    margin-bottom: 10px;
    color: #444;
}

.profile-info strong {
    color: #222;
}

/* Immagine profilo */
.profile-image {
    text-align: center;
    min-width: 200px;
}

.profile-pic {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #4682B4;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    margin-top: 10px;
}

/* Sezione abbonamento */
.section-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
}

.profile-section h3 {
    color: #333;
    margin-bottom: 15px;
    border-left: 5px solid #2196F3;
    padding-left: 10px;
}

.section-image {
    width: 100%;
    max-width: 400px;
    height: auto;
    display: block;
    margin: 10px 0;
    border-radius: 8px;
    border: 2px solid #ccc;
}

/* Pulsanti */
.button-container {
    text-align: center;
    margin-top: 20px;
}

.edit-button {
    background-color: #4682B4;
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-button:hover {
    background-color: #4682B4;
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
        <?php if (count($_smarty_tpl->tpl_vars['insurance']->value) > 0) {?>
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
        <?php }?>

        <div class="button-container">
            <a href="/Slope/User/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
        </div>

        

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
