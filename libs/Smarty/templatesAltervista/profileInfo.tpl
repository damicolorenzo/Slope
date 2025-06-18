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
  .super-button {
    background-color:rgb(201, 198, 53);
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
.creditCard {
  background: linear-gradient(135deg, #f8fafc, #e2e8f0);
  border: 1px solid #cbd5e0;
  border-radius: 12px;
  padding: 20px;
  max-width: 400px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  font-family: 'Segoe UI', sans-serif;
}

.creditCard h2 {
  margin-bottom: 16px;
  font-size: 1.4rem;
  color: #2d3748;
}

.card-details p {
  margin: 8px 0;
  font-size: 1rem;
  color: #4a5568;
}

.card-actions {
  margin-top: 20px;
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.95rem;
  transition: background-color 0.2s;
}

.btn.edit {
  background-color: #3182ce;
  color: white;
}

.btn.edit:hover {
  background-color: #2b6cb0;
}

.btn.remove {
  background-color: #e53e3e;
  color: white;
}

.btn.remove:hover {
  background-color: #c53030;
} 

.subscription-box {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  padding: 20px;
  margin-top: 20px;
  border-radius: 8px;
  font-family: Arial, sans-serif;
  color: #333;
}

.subscription-box h2 {
  margin-top: 0;
  color: #2c3e50;
}

.subscription-box p {
  margin: 5px 0;
  font-size: 14px;
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

      <div class="container profileInfo" data-aos="fade-up">
        
        <div class="profile-container">
          <div class="profile-info">
              <h2>INFORMAZIONI PROFILO</h2>
              <p><strong>Nome utente:</strong> {$username}</p>
              <p><strong>Nome:</strong> {$name}</p>
              <p><strong>Cognome:</strong> {$surname}</p>
              <p><strong>Email di conferma:</strong> {$email}</p>
              <p><strong>Numero di telefono:</strong> {$phoneNumber}</p>
              <p><strong>Data nascita:</strong> {$birthDate}</p>
          </div>
          <div class="profile-image">
              <!-- Immagine del profilo -->
              {if $image == []} 
                <img class="profile-pic" src="/libs/Smarty/images/NotFound.jpg" loading="lazy" alt="Img">
              {else}
              {foreach from=$image item=i}
                <img class="profile-pic" src="data:{$i->getType()};base64,{$i->getEncodedData()}" loading="lazy" alt="Img">
              {/foreach}
              {/if}
          </div>
        </div>
        <div class="button-container">
            <a href="/User/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
        </div>
        {if count($creditCard) > 0}
        <div class="creditCard">
          <h2>Metodo di Pagamento</h2>
          <div class="card-details">
            <p><strong>Nome:</strong> {$creditCard[0]->getCardHolderName()}</p>
            <p><strong>Cognome:</strong> {$creditCard[0]->getCardHolderSurname()}</p>
            <p><strong>Numero Carta:</strong> **** **** **** {substr($creditCard[0]->getCardNumber(), -4)}</p>
            <p><strong>Scadenza:</strong> {$creditCard[0]->getExpiryDate()}</p>
            <p><strong>CVV:</strong> ***</p>
          </div>
          <div class="card-actions">
            <form action="/User/modifyCreditCard" class="modifyCreditCard"  enctype="multipart/form-data" method="POST">
            <button type=submit class="btn edit">Modifica</button>
            </form>
            <form action="/User/deleteCreditCard" class="deleteCreditCard"  enctype="multipart/form-data" method="POST">
            <button class="btn remove">Rimuovi Carta</button>
            </form>
          </div>
        </div>
        {/if}
        {if count($subscription) > 0}
        <div class="subscription-box">
          <h2>Abbonamento</h2>
          <p>Data inizio: {$subscription[0]->getStartDate()}</p>
          <p>Data fine: {$subscription[0]->getEndDate()}</p>
        </div>
        {/if}
        {if count($insurance) > 0}
        <div class="section-container">
            <div class="profile-section">
                <h3>ABBONAMENTO</h3>
                <!-- Immagine dell'abbonamento -->
                {if $subscriptionImage === false}
                <img src="/libs/Smarty/images/NotFound.jpg" alt="Immagine abbonamento" class="section-image">
                {/if}
                <div class="button-container">
                    <a href="/User/buySubscription"><button class="edit-button">Acquista</button></a>
              </div>
            </div>
        </div>
        {/if}

        
        {if count($subscription) <= 0}
        <div class="button-container">
            <a href="/User/buySubscription"><button class="super-button">Acquista abbonamento</button></a>
        </div>
        {/if}

      <!-- Da riempire in base alla pagina  -->

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