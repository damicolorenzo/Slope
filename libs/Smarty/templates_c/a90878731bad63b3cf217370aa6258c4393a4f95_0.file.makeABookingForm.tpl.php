<?php
/* Smarty version 3.1.33, created on 2025-05-13 15:50:04
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\makeABookingForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68234e0c0363c3_11303349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a90878731bad63b3cf217370aa6258c4393a4f95' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\makeABookingForm.tpl',
      1 => 1747144187,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68234e0c0363c3_11303349 (Smarty_Internal_Template $_smarty_tpl) {
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

  h1 {
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
  }

  label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
  }

  input[type="text"],
  input[type="email"],
  input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .durata-skipass {
    margin-bottom: 15px;
  }

  .durata-skipass p, .tipologia-biglietto p {
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="checkbox"],
  input[type="radio"] {
    margin-right: 10px;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #4682B4;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  button:hover {
    background-color: #FF7F50;
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

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 

      <div class="container" data-aos="fade-up">

        <div class="form-container">
        <h1>Form di prenotazione</h1>
        <form action="/Slope/User/confirmBooking" method="post">
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
                <?php if ($_smarty_tpl->tpl_vars['i']->value[0] == 1) {?>
                <label><input type="radio" name="period" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
 required> <?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
 giorno-<?php echo $_smarty_tpl->tpl_vars['i']->value[1];?>
</label>
                <input type="hidden" name="type" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[1];?>
>
                <?php } elseif ($_smarty_tpl->tpl_vars['i']->value[0] > 1) {?>
                <label><input type="radio" name="period" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
 required> <?php echo $_smarty_tpl->tpl_vars['i']->value[0];?>
 giorni-<?php echo $_smarty_tpl->tpl_vars['i']->value[1];?>
</label>
                <input type="hidden" name="type" value=<?php echo $_smarty_tpl->tpl_vars['i']->value[1];?>
>
                <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            

            <div class="acquista-assicurazione">
                <label><input type="checkbox" name="insurance" checked > Acquista assicurazione</label>
            </div>

            <label for="data">Seleziona una data</label>
            <input type="date" id="date" name="date" min=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 value=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
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
