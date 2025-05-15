<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Registration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/libs/Smarty/day/assets/img/favicon.png" rel="icon">
  <link href="/libs/Smarty/day/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/libs/Smarty/day/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/libs/Smarty/day/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/libs/Smarty/day/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="/libs/Smarty/day/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="/libs/Smarty/day/assets/css/main.css" rel="stylesheet">

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
        <a href="/" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Slope</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/User/showBookings">Visualizza Prenotazioni</a></li>
            <li><a href="/User/profile">Profile</a></li>
            <li><a href="/User/logout">LogOut</a></li>
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
                  {foreach from=$cart item=i}
                    {if $i instanceof ESkipassBooking}
                    <li>
                        <span>Skipass</span>
                        <span>€{$i->getValue()}</span>
                    </li>
                    {/if}
                    {if $i instanceof EInsurance}
                    <li>
                        <span>Assicurazione</span>
                        <span>€{$i->getPrice()}</span>
                    </li>
                    {/if}
                  {/foreach}
                  <li class="total">
                      <span><strong>Totale</strong></span>
                      <span><strong>€{$totalPrice}</strong></span>
                  </li>
              </ul>
            </div>
        
            <form action="/User/payment" class="payment-form"  enctype="multipart/form-data" method="POST">
              <h2>Paga con Carta di Credito</h2>
                <div class="form-group">
                    <label for="cardHolderName">Nome Intestatario Carta</label>
                    {if $creditCard === null}
                    <input type="text" id="card-name" name="cardHolderName" placeholder="Mario" required>
                    {else}
                    <input type="text" id="card-name" name="cardHolderName" value={$creditCard->getCardHolderName()} required>
                    {/if}
                </div>
                <div class="form-group">
                    <label for="cardHolderSurname">Cognome Intestatario Carta</label>
                    {if $creditCard === null}
                    <input type="text" id="card-surname" name="cardHolderSurname" placeholder="Rossi" required>
                    {else}
                    <input type="text" id="card-surname" name="cardHolderSurname" value={$creditCard->getCardHolderSurname()} required>
                    {/if}
                </div>
                <div class="form-group">
                    <label for="cardNumber">Numero Carta</label>
                    {if $creditCard === null}
                    <input type="text" id="card-number" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19"  required>
                    {else}
                    <input type="text" id="card-number" name="cardNumber" value={$creditCard->getCardNumber()} maxlength="19"  required>
                    {/if}
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiryDate">Scadenza Carta</label>
                        {if $creditCard === null}
                        <input type="month" id="expiry-date" name="expiryDate" required>
                        {else}
                        <input type="month" id="expiry-date" name="expiryDate" value={$creditCard->getExpiryDate()} required>
                        {/if}
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        {if $creditCard === null}
                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  required>
                        {else}
                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="3"  value={$creditCard->getCvv()} required>
                        {/if}
                    </div>
                </div>
                {if $creditCard === null}
                <div class="form-group">
                  <label for="preferred">Salvare come metodo preferito</label>
                  <input type="checkbox" id="preferred" name="preferred" >
                </div>
                {else} 
                <div class="form-group">
                  <label for="preferred">Salvare come metodo preferito</label>
                  <input type="checkbox" id="preferred" name="preferred" checked>
                </div>
                {/if}
                
                <button type="submit" class="submit-btn">Procedi al Pagamento</button>
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
  <script src="/libs/Smarty/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/php-email-form/validate.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/aos/aos.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="/libs/Smarty/day/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="/libs/Smarty/day/assets/js/main.js"></script>

</body>

</html>