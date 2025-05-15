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

    <!-- Page Title -->
    <!-- <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
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

        <div class="button-container">
            <a href="/User/modifyProfile"><button class="edit-button">Modifica profilo</button></a>
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