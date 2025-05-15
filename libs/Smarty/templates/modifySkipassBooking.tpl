<!DOCTYPE html>
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
          <h1>Modifica prenotazione</h1>
          <form action="/Slope/User/confirmModifyBooking" method="post">
              <label for="name">Nome</label>
              <input type="text" id="name" name="name" value={$skipassBooking->getName()}>

              <label for="surname">Cognome</label>
              <input type="text" id="surname" name="surname" value={$skipassBooking->getSurname()}>

              <label for="email">Email di conferma</label>
              <input type="email" id="email" name="email" value={$skipassBooking->getEmail()}  disabled>

              <div class="durata-skipass">
                  <p>Durata skipass</p>
                  {if $skipassBooking->getPeriod() == 1}
                  <label><input type="radio" name="period" value="giornaliero" checked readonly> Giornaliero</label>
                  {/if}
                  {if $skipassBooking->getPeriod() == 7}
                  <label><input type="radio" name="period" value="settimanale" checked readonly> Settimanale</label>
                  {/if}
                  {if $skipassBooking->getPeriod() == 30}
                  <label><input type="radio" name="period" value="mensile" checked readonly> Mensile</label>
                  {/if}
                  {if $skipassBooking->getPeriod() == 30*6}
                  <label><input type="radio" name="period" value="stagionale" checked readonly> Stagionale</label>
                  {/if}
              </div>

              <div class="tipologia-biglietto">
                  <p>Tipologia biglietto</p>
                  {if $skipassBooking->getType() == 'intero'}
                  <label><input type="radio" name="type" value="intero" checked readonly> Intero</label>
                  {else}
                  <label><input type="radio" name="type" value="ridotto" checked readonly> Ridotto</label>
                  {/if}
              </div>

              <label for="data">Seleziona una data</label>
              <input type="date" id="date" name="date" min={$today} value={$skipassBooking->getStartDate()}>
              {if $dateWarning } 
              <label>Controllare se la data inserita è corretta. La data potrebbe essere troppo lontana da quella corrente.</label>
              {/if}

              <button type="submit">Conferma</button>
          </form>
          
        </div>
        {if count($insurance) <= 0}
        <div class="acquista-assicurazione">
            <form action="/Slope/User/buyInsurance" method="post">
            <button type="submit">Acquista assicurazione</button>
            </form>
        </div>
        {/if}
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