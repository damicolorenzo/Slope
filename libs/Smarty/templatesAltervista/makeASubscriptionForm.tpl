<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Acquista abbonamento</title>

  <!-- Favicons -->
  <link href="/libs/Smarty/day/assets/img/light/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: dark)">
  <link href="/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: dark)">
  <link href="/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: dark)">

  <link href="/libs/Smarty/day/assets/img/dark/favicon-32x32.png" rel="icon" sizes="32x32" media="(prefers-color-scheme: light)">
  <link href="/libs/Smarty/day/assets/img/light/favicon-16x16.png" rel="icon" sizes="16x16" media="(prefers-color-scheme: light)">
  <link href="/libs/Smarty/day/assets/img/light/apple-touch-icon.png" rel="apple-touch-icon" media="(prefers-color-scheme: light)">

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
            <li><a href="/ManageBooking/showBookings">Visualizza Prenotazioni</a></li>
            <li><a href="/UserOperation/profile">Profile</a></li>
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

      <div class="container makeASubscriptionForm" data-aos="fade-up">
  
        <div class="form-container">
          <h1>Acquista abbonamento</h1>
            <form action="/PurchaseSubscription/confirmSubscription" method="POST">
              <label for="name">Nome</label>
              <input type="text" id="name" name="name" value={$user->getName()}>

              <label for="surname">Cognome</label>
              <input type="text" id="surname" name="surname" value={$user->getSurname()}>

              <label for="email">Email di conferma</label>
              <input type="email" id="email" name="email" value={$user->getEmail()}>

              <label for="startDate">Data inizio abbonamento: {$startDate}</label>
              <input type="hidden" id="startDate" name="startDate" value={$startDate}>
              
              <label for="startDate">Data fine abbonamento: {$endDate}</label>
              <input type="hidden" id="endDate" name="endDate" value={$endDate}>
              
              <button type="submit" >Procedi all'acquisto</button> 
            </form>
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