<?php
/* Smarty version 3.1.33, created on 2025-05-13 14:40:28
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\insurancePaymentSection.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_68233dbc45de88_27278797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4928e140052f071b0de18339bf2e30ce210daec' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\insurancePaymentSection.tpl',
      1 => 1747140023,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68233dbc45de88_27278797 (Smarty_Internal_Template $_smarty_tpl) {
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
  .payment-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 600px; /* Adatta la larghezza */
    width: 90%;       /* Adattabile su dispositivi piccoli */
    margin: 40px auto; /* Centra orizzontalmente e aggiunge spazio sopra/sotto */
  }

  .order-summary {
    margin-bottom: 20px;
  }

  .order-summary h2 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #444;
  }

  .order-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .order-list li {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px solid #eee;
    font-size: 16px;
  }

  .order-list li.total {
    font-weight: bold;
    border-top: 2px solid #444;
    margin-top: 10px;
    padding-top: 10px;
  }

  .payment-container h1 {
    margin-bottom: 20px;
    text-align: center;
    color: #444;
  }

  .payment-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  .form-group label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
  }

  .form-group input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #333;
  }

  .form-group input:focus {
    border-color: #4682B4;
    outline: none;
  }

  .form-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
  }

  .form-row .form-group {
    flex: 1;
  }

  .submit-btn {
    background-color: #4682B4;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .submit-btn:hover {
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

        <div class="payment-container">
        <h1>Riepilogo Pagamento</h1>
        
          <!-- Dettagli acquisto -->
          <div class="order-summary">
              <h2>Dettagli Acquisto</h2>
              <ul class="order-list">
                  <li>
                      <span>Assicurazione</span>
                      <span>€<?php echo $_smarty_tpl->tpl_vars['insurance']->value->getPrice();?>
</span>
                  </li>
                  <li class="total">
                      <span><strong>Totale</strong></span>
                      <span><strong>€<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
</strong></span>
                  </li>
              </ul>
          </div>
        
          <form action="/Slope/User/insurancePayment" class="payment-form"  enctype="multipart/form-data" method="POST">
            <h2>Paga con Carta di Credito</h2>
              <div class="form-group">
                  <label for="cardHolderName">Nome Intestatario Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-name" name="cardHolderName" placeholder="Mario" required>
                  <?php } else { ?>
                  <input type="text" id="card-name" name="cardHolderName" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardHolderName();?>
 required>
                  <?php }?>
              </div>
              <div class="form-group">
                  <label for="cardHolderSurname">Cognome Intestatario Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-surname" name="cardHolderSurname" placeholder="Rossi" required>
                  <?php } else { ?>
                  <input type="text" id="card-surname" name="cardHolderSurname" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardHolderSurname();?>
 required>
                  <?php }?>
              </div>
              <div class="form-group">
                  <label for="cardNumber">Numero Carta</label>
                  <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                  <input type="text" id="card-number" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"  required>
                  <?php } else { ?>
                  <input type="text" id="card-number" name="cardNumber" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCardNumber();?>
 maxlength="19"  required>
                  <?php }?>
              </div>
              <div class="form-row">
                  <div class="form-group">
                      <label for="expiryDate">Scadenza Carta</label>
                      <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                      <input type="month" id="expiry-date" name="expiryDate" required>
                      <?php } else { ?>
                      <input type="month" id="expiry-date" name="expiryDate" value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getExpiryDate();?>
 required>
                      <?php }?>
                  </div>
                  <div class="form-group">
                      <label for="cvv">CVV</label>
                      <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
                      <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  required>
                      <?php } else { ?>
                      <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  value=<?php echo $_smarty_tpl->tpl_vars['creditCard']->value->getCvv();?>
 required>
                      <?php }?>
                  </div>
              </div>
              <?php if ($_smarty_tpl->tpl_vars['creditCard']->value === null) {?>
              <div class="form-group">
                <label for="preferred">Salvare come metodo preferito</label>
                <input type="checkbox" id="preferred" name="preferred" >
              </div>
              <?php } else { ?> 
              <div class="form-group">
                <label for="preferred">Salvare come metodo preferito</label>
                <input type="checkbox" id="preferred" name="preferred" checked>
              </div>
              <?php }?>
              
              <button type="submit" class="submit-btn">Procedi al Pagamento</button>
          </form>

        </div>

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
