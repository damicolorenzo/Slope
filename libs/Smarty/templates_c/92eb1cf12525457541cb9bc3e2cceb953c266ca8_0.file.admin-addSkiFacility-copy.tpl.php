<?php
/* Smarty version 3.1.33, created on 2025-05-12 14:38:45
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\admin-addSkiFacility-copy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6821ebd55feaa8_71997795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92eb1cf12525457541cb9bc3e2cceb953c266ca8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\admin-addSkiFacility-copy.tpl',
      1 => 1747053523,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6821ebd55feaa8_71997795 (Smarty_Internal_Template $_smarty_tpl) {
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
.dashboard {
  display: flex;
  gap: 2%;
  flex-wrap: wrap;
  align-content: start;
}

.item:nth-child(1),
.item:nth-child(4) {
  width: 100%;
  height: 5%;
}

.item:nth-child(2) {
  width: 25%;
  height: 75%;
}

.item:nth-child(3) {
  flex-grow: 1;
  height: 75%;
}

.item:nth-child(2) a {
  display: block;
  margin: 8px 0;
  padding: 12px 16px;
  background-color: #f0f4f8;
  color: #2c3e50;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 500;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.item:nth-child(2) a:hover {
  background-color:rgb(219, 63, 52);
  color: white;
  transform: translateX(5px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.chart {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 600px;
    margin: 20px auto;
    font-family: sans-serif;
  }

  .bar {
    display: flex;
    align-items: center;
  }

  .bar-label {
    width: 100px;
    text-align: right;
    margin-right: 10px;
    font-weight: bold;
  }

  .bar-value {
    height: 30px;
    background-color:rgb(219, 77, 52);
    border-radius: 6px;
    transition: width 0.3s ease;
    text-align: right;
    color: white;
    padding-right: 10px;
    line-height: 30px;
  }

.stat-card {
    width: 300px;
    height: 150px;
    background: linear-gradient(135deg, #3498db, #8e44ad);
    color: white;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: all 0.3s ease;
  }

  .stat-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .stat-card i {
    font-size: 40px;
    margin-bottom: 15px;
  }

  .stat-card .number {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .stat-card .label {
    font-size: 16px;
    font-weight: 500;
  }

  /* Optional: Style for a larger container */
  .stat-container {
    display: flex;
    justify-content: center;
    margin-top: 50px;
  }


  .form_login-container {
  max-width: 500px;
  margin: 20px auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 15px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.register-form h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #343a40;
}

.section {
  margin-bottom: 10px;
}

.section label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #495057;
}

input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 10px 14px;
  font-size: 16px;
  border: 1px solid #ced4da;
  border-radius: 8px;
  background-color: #fff;
  box-sizing: border-box;
  transition: border 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus {
  border-color:rgb(224, 18, 18);
  outline: none;
}

.radio-group {
  display: flex;
  gap: 20px;
  padding: 5px 0;
}

.radio-group label {
  display: flex;
  align-items: center;
  font-weight: 500;
  cursor: pointer;
}

.radio-group input[type="radio"] {
  margin-right: 6px;
}

.btn-submit {
  display: block;
  width: 100%;
  padding: 12px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  background-color:rgb(209, 67, 11);
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
  background-color:rgb(221, 15, 15);
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
            <!-- <li><a href="#hero">Home</a></li>
            <li><a href="#about">Prenota</a></li>
            <li><a href="#services">Visualizza prenotazioni</a></li>
            <li class="dropdown"><a href="#"><span>Aggiornamenti</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a> -->
              <ul>
                <!-- <li><a href="#">Piste</a></li>
                <li><a href="#">Impianti</a></li>
                <li><a href="#">Web</a></li> -->
              </ul>
            </li>
            <li><a href="/Slope/">Home</a></li>
            <li><a href="/Slope/User/login">Login</a></li>
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

      <div class="dashboard">
        <div class="item"></div>
        <div class="item">
          <a href="/Slope/Admin/addSkiRun">Aggiungi dati pista</a>
          <a href="/Slope/Admin/addSkiFacility">Aggiungi dati impianto</a>
          <a href="/Slope/Admin/addLiftStructure">Aggiungi dati risalita</a>
          <a href="/Slope/Admin/searchUsers">Modifica dati utente</a>
          <a href="/Slope/Admin/searchStructures">Modifica dati pista/impianto/risalita</a>
          <a href="/Slope/Admin/addSkipassTemplate">Aggiungi template skipass</a>
          <a href="/Slope/Admin/addInsuranceTemplate">Aggiungi template assicurazione</a>
          <a href="/Slope/Admin/addSkipassObj">Aggiungi oggetto skipass</a>
          <!--
          <a href="/Slope/Admin/searchPrices">Modifica prezzi</a>
          <a href="/Slope/Admin/addPrice">Aggiungi prezzo</a>
          -->
          <a href="/Slope/Admin/searchSkipassTemplate">Modifica template skipass</a>
          <a href="/Slope/Admin/searchSkipassObjs">Modifica oggetto skipass</a>
          <a href="/Slope/Admin/addSkipass">Aggiungi skipass template</a>
          <a href="/Slope/Admin/modifySkiFacilityImage">Aggiungi immagini impianto</a>
          <a href="/Slope/Admin/modifyLandingPage">Modifica interfaccia</a>
        </div>

        <div class="item">
        <div class="form_login-container">
            <form class="register-form" action="/Slope/Admin/confirmSkiFacility" method="POST">
              <h2>Nuovo impianto</h2>
        
              <div class="section">
                <label for="nome-risalita">Nome impianto</label>
                <input type="text" id="nome-impianto" placeholder="Inserisci nome impianto">
              </div>
      
              <div class="section">
                  <label>Praticabilità</label>
                  <div class="radio-group">
                      <label><input type="radio" name="stauts" value="aperto"> Aperto</label>
                      <label><input type="radio" name="stauts" value="chiuso"> Chiuso</label>
                  </div>
              </div>
      
              <div class="section">
                <label for="price">Prezzo</label>
                <input type="number" id="price" name="price" required>
              </div>  
              
                
                <button type="submit" class="btn-submit">Conferma</button>
            </form>
        </div>
        </div>

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
