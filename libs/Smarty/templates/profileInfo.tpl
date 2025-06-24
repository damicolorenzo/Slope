<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profilo</title>

  <!-- Favicons -->
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: dark)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: dark)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: dark)">

  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/dark/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: light)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: light)">
  <link href="https://localhost/Slope/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: light)">
  
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
            <li><a href="/Slope/ManageBooking/showBookings">Visualizza Prenotazioni</a></li>
            <li><a href="/Slope/UserOperations/profile">Profile</a></li>
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
                <img class="profile-pic" src="https://localhost/Slope/libs/Smarty/images/NotFound.jpg" loading="lazy" alt="Img">
              {else}
              {foreach from=$image item=i}
                <img class="profile-pic" src="data:{$i->getType()};base64,{$i->getEncodedData()}" loading="lazy" alt="Img">
              {/foreach}
              {/if}
          </div>
        </div>
        <div class="button-container">
            <a href="/Slope/UserOperations/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
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
            <form action="/Slope/UserOperations/modifyCreditCard" class="modifyCreditCard"  enctype="multipart/form-data" method="POST">
            <button type=submit class="btn edit">Modifica</button>
            </form>
            <form action="/Slope/UserOperations/deleteCreditCard" class="deleteCreditCard"  enctype="multipart/form-data" method="POST">
            <button class="btn remove">Rimuovi Carta</button>
            </form>
          </div>
        </div>
        {/if}
        {if count($subscription) > 0}
        {if $rebuySub}
        <div class="subscription-box">
          <h2>Abbonamento</h2>
          <p>Data inizio: {$subscription[0]->getStartDate()}</p>
          <p>Data fine: {$subscription[0]->getEndDate()}</p>
          <div class="button-container">
            <a href="/Slope/PurchaseSubscription/rebuySubscription"><button class="edit-button">Acquista nuovamente</button></a>
          </div>
        </div>
        {else}
        <div class="subscription-box">
          <h2>Abbonamento</h2>
          <p>Data inizio: {$subscription[0]->getStartDate()}</p>
          <p>Data fine: {$subscription[0]->getEndDate()}</p>
        </div>
        {/if}
        {/if}
        {if count($subscription) <= 0}
        <div class="button-container">
            <a href="/Slope/PurchaseSubscription/buySubscription"><button class="super-button">Acquista abbonamento</button></a>
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
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/aos/aos.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="https://localhost/Slope/libs/Smarty/day/assets/js/main.js"></script>

</body>

</html>