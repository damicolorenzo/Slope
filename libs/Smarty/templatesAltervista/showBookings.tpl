<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Visualizza prenotazioni</title>

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

      <div class="container showBookings" data-aos="fade-up">

        <div class="calendar-container">
        <h2>
          <form action="/Slope/ManageBooking/showBookings" method="POST">
            <input type="hidden" name="month" value={$prevMonth}>
            <input type="hidden" name="year" value={$prevYear}>
            <button type="submit">&laquo;</button>
          </form>

          {$monthName} {$year}

          <form action="/Slope/ManageBooking/showBookings" method="POST">
            <input type="hidden" name="month" value={$nextMonth}>
            <input type="hidden" name="year" value={$nextYear}>
            <button type="submit">&raquo;</button>
          </form>
        </h2>
        <div class="calendar-scroll-wrapper">
        <table>
          <tr>
            <th>Mon</th><th>Tue</th>
            <th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
          </tr>

          {foreach from=$calendar item=week}
            <tr>
              {foreach from=$week item=day}
                {if $day}
                  {if in_array($day, $bookedDates)} <!-- Controlla se il giorno è prenotato -->
                    <td class="booked">
                      <a href="#booking-{$idForDate[$day][0]}" class="booked-link">{$day}</a>
                      <div class="booking-text">{$idForDate[$day][1]}</div>
                    </td> <!-- Giorno prenotato con stile speciale -->
                  {else}
                    <td>{$day}</td> <!-- Giorno normale -->
                  {/if}
                {/if}
              {/foreach}
            </tr>
          {/foreach}
        </table>
        </div>
      </div>

      {if count($bookings) > 0}
      <h1>Dati prenotazione</h1>
      <div class="card-booking-wrapper">
        {foreach $bookings item=e}
          <div class="booking-card" id="booking-{$e['bookings'][0]->getIdSkipassBooking()}">
            <p><strong>Nome:</strong> {$e['bookings'][0]->getName()}</p>
            <p><strong>Cognome:</strong> {$e['bookings'][0]->getSurname()}</p>
            <p><strong>Email:</strong> {$e['bookings'][0]->getEmail()}</p>
            <p><strong>Data:</strong> {$e['bookings'][0]->getStartDate()}</p>
            <p><strong>Periodo:</strong> {$e['bookings'][0]->getPeriod()}</p>
            <p><strong>Tipo:</strong> {$e['bookings'][0]->getType()}</p>
            <p><strong>Prezzo totale:</strong> {$e['bookings'][0]->getValue()}</p>
            <p><strong>Impianto sci:</strong> {$e['bookings'][1]->getName()}</p>
          
            {if $e['bookings'][2] != []}
              <p><strong>Assicurazione:</strong></p>
              <img class="imagePreview" src="https://localhost/Slope/libs/Smarty/images/checked.png">
            {else}
              <div class="flex">
                <p><strong>Assicurazione:</strong></p>
                <form action="/Slope/PurchaseInsurance/buyInsurance" method="POST">
                  <input type="hidden" name="idSkipassBooking" value="{$e['bookings'][0]->getIdSkipassBooking()}">
                  <button type="submit" class="btn-insurance">Acquista</button>
                </form>
              </div>
            {/if}

            <div class="booking-actions">
              <form action="/Slope/ManageBooking/modifySkipassBooking" method="POST">
                <input type="hidden" name="idSkipassBooking" value="{$e['bookings'][0]->getIdSkipassBooking()}">
                <button type="submit" class="btn-mod">Modifica</button>
              </form>

              <form action="/Slope/ManageBooking/deleteSkipassBooking" method="POST">
                <input type="hidden" name="idSkipassBooking" value="{$e['bookings'][0]->getIdSkipassBooking()}">
                <button type="submit" class="btn-er">Elimina</button>
              </form>
            </div>
          </div>
        {/foreach}
        {foreach from=$oldBookings item=e}
          <h2>Prenotazioni scadute</h2>
          <div class="booking-card" id="booking-{$e['bookings'][0]->getIdSkipassBooking()}">
            <p><strong>Nome:</strong> {$e['bookings'][0]->getName()}</p>
            <p><strong>Cognome:</strong> {$e['bookings'][0]->getSurname()}</p>
            <p><strong>Email:</strong> {$e['bookings'][0]->getEmail()}</p>
            <p><strong>Data:</strong> {$e['bookings'][0]->getStartDate()}</p>
            <p><strong>Periodo:</strong> {$e['bookings'][0]->getPeriod()}</p>
            <p><strong>Tipo:</strong> {$e['bookings'][0]->getType()}</p>
            <p><strong>Prezzo totale:</strong> {$e['bookings'][0]->getValue()}</p>
            <p><strong>Impianto sci:</strong> {$e['bookings'][1]->getName()}</p>
          </div>
        {/foreach}
      </div>
    {else}
      <label>Nessuna prenotazione effettuata</label>
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
