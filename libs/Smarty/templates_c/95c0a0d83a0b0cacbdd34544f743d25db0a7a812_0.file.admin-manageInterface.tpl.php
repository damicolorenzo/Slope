<?php
/* Smarty version 3.1.33, created on 2025-05-13 17:33:17
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\admin-manageInterface.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6823663dccd0b8_23988249',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95c0a0d83a0b0cacbdd34544f743d25db0a7a812' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\admin-manageInterface.tpl',
      1 => 1747150395,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6823663dccd0b8_23988249 (Smarty_Internal_Template $_smarty_tpl) {
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

.form-container {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

    max-width: 600px; /* Adatta la larghezza */
    width: 90%;       /* Adattabile su dispositivi piccoli */
    margin: 40px auto; /* Centra orizzontalmente e aggiunge spazio sopra/sotto */
  }

  @media (max-width: 600px) {
    .form-container {
      padding: 15px;
    }

    button {
      font-size: 14px;
      padding: 8px;
    }
  }

  .form-container h1 {
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
  }


.block {
  background-color: white;
  border: 1px solid #ccc;
  padding: 20px;
  margin-bottom: 10px;
  text-align: center;
}

.flex-row {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
}

.half {
  flex: 1;
  background-color: white;
  border: 1px solid #ccc;
  padding: 20px;
  text-align: center;
}

.center {
  justify-content: center;
}

.foto-block {
  background-color: white;
  border: 1px solid #ccc;
  padding: 20px;
  width: 150px;
  text-align: center;
}

#imagePreview {
  max-width: 100%; 
  height: auto; 
  
}
  </style>
</head>

<body class="starter-page-page">

  <header id="header-admin" class="header-admin sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/Slope" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
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

        <div class="form-container">
          <section class="block">Head bar</section>

          <section class="block">
            <p>Image 1</p>
            <?php if ($_smarty_tpl->tpl_vars['image1']->value) {?>
            <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image1']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                  <img id="imagePreview" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img" >
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <?php }?>
            <form action="/Slope/Admin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
              <input type="hidden" name="idImage" id="idImage" value="1">
              <button class="edit-button" type="submit">Modifica immagine</button>
            </form>
          </section>

          <section class="block">About us</section>

          <section class="flex-row">
            <div class="half">Description</div>
            <div class="half">
              <p>Image 2</p>
              <?php if ($_smarty_tpl->tpl_vars['image2']->value) {?>
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image2']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                  <img id="imagePreview" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img" >
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              <?php }?>
            <form action="/Slope/Admin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
              <input type="hidden" name="idImage" id="idImage" value="2">
              <button class="edit-button" type="submit">Modifica immagine</button>
            </form>
            </div>
          </section>

          <section class="block">Dove sciare</section>
          <section class="block">Impianti</section>
          <section class="block">Servizi</section>
          <section class="block">Servizi</section>
          <section class="block">Pricing</section>
          <section class="block">Prezzi</section>
          <section class="block">Team</section>

          <section class="flex-row center">
            <div class="foto-block">
              <p>Foto 1</p>
              <?php if ($_smarty_tpl->tpl_vars['image3']->value) {?>
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image3']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                  <img id="imagePreview" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img" >
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              <?php }?>
              <form action="/Slope/Admin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="idImage" id="idImage" value="3">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
            <div class="foto-block">
              <p>Foto 2</p>
              <?php if ($_smarty_tpl->tpl_vars['image4']->value) {?>
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image4']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                  <img id="imagePreview" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img" >
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              <?php }?>
              <form action="/Slope/Admin/addImageLandingPage" enctype="multipart/form-data" method="POST">
                <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="idImage" id="idImage" value="4">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
            <div class="foto-block">
              <p>Foto 3</p>
              <?php if ($_smarty_tpl->tpl_vars['image5']->value) {?>
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['image5']->value, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                  <img id="imagePreview" src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img" >
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              <?php }?>
              <form action="/Slope/Admin/addImageLandingPage" enctype="multipart/form-data" method="POST">
                <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="idImage" id="idImage" value="5">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
          </section>

          <section class="block">Contatti</section>
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
