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
.table-container {
width: 100%;
margin: 20px auto;
overflow-x: auto;
background: #fff;
padding: 20px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
border-radius: 8px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
}

thead {
    background-color: #4682B4;
    color: white;
}

th, td {
    text-align: left;
    padding: 12px 15px;
    border: 1px solid #ddd;
}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

th {
    text-transform: uppercase;
}

td {
    font-size: 14px;
}

.booked {
    color: white;
    background-color: #4682B4
}

/* Contenitore del calendario */
.calendar-container {
  max-width: 600px;
  margin: 40px auto;
  padding: 20px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
  text-align: center;
}

/* Titolo e navigazione mese */
.calendar-container h2 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 20px;
  margin-bottom: 20px;
}

.calendar-container h2 form {
  margin: 0;
}

.calendar-container h2 button {
  background: #4682B4;
  color: #fff;
  border: none;
  padding: 5px 10px;
  font-size: 18px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.calendar-container h2 button:hover {
  background-color: #4682B4;
}

/* Tabella calendario */
.calendar-container table {
  width: 100%;
  border-collapse: collapse;
  font-size: 16px;
}

.calendar-container th, .calendar-container td {
  padding: 10px;
  border: 1px solid #ddd;
  width: 14.28%;
  height: 60px;
  vertical-align: top;
  text-align: center;
}

.calendar-container th {
  background-color: #f0f0f0;
  color: #333;
  font-weight: bold;
}

.btn-mod {
    background-color:#4682B4;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-er {
    background-color: #FF7F50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.true {
  text-align: center;
}

.imagePreview {
  width: 30%;
  height: 30%;   
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


      <div class="calendar-container">
        <h2>
          <form action="/User/showBookings" method="POST">
            <input type="hidden" name="month" value={$prevMonth}>
            <input type="hidden" name="year" value={$prevYear}>
            <button type="submit">&laquo;</button>
          </form>

          {$monthName} {$year}

          <form action="/User/showBookings" method="POST">
            <input type="hidden" name="month" value={$nextMonth}>
            <input type="hidden" name="year" value={$nextYear}>
            <button type="submit">&raquo;</button>
          </form>
        </h2>

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
                    <td class="booked">{$day}</td> <!-- Giorno prenotato con stile speciale -->
                  {else}
                    <td>{$day}</td> <!-- Giorno normale -->
                  {/if}
                {/if}
              {/foreach}
            </tr>
          {/foreach}
        </table>
      </div>


      {if count($bookings) > 0}
      <h1>Dati prenotazione</h1>
      {foreach $bookings item=e}
      <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Period</th>
                    <th>Type</th>
                    <th>Total Price</th>
                    <th>Ski Facility</th>
                    <th>Insurance<th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{$e['bookings'][0]->getName()}</td>
                    <td>{$e['bookings'][0]->getSurname()}</td>
                    <td>{$e['bookings'][0]->getEmail()}</td>
                    <td>{$e['bookings'][0]->getStartDate()}</td>
                    <td>{$e['bookings'][0]->getPeriod()}</td>
                    <td>{$e['bookings'][0]->getType()}</td>
                    <td>{$e['bookings'][0]->getValue()}</td>
                    <td>{$e['bookings'][1]->getName()}</td>
                    {if $e['bookings'][2] != []}
                    <td class="true"><img class="imagePreview" src="/libs/Smarty/images/checked.png"></td>
                    {else}
                    <td><form action="/User/buyInsurance" method="POST"><input type="hidden" name="idSkipassBooking" value={$e['bookings'][0]->getIdSkipassBooking()}><button type="submit">Acquista</button></form></td>
                    {/if}
                    <form action="/User/modifySkipassBooking" method="POST"><td><input type="hidden" name="idSkipassBooking" value={$e['bookings'][0]->getIdSkipassBooking()}><button type="submit" class="btn-mod">Modifica</button></td></form>
                    <form action="/User/deleteSkipassBooking" method="POST"><td><input type="hidden" name="idSkipassBooking" value={$e['bookings'][0]->getIdSkipassBooking()}><button type="submit" class="btn-er">Elimina</button></td></form>
                </tr>
            </tbody>
        </table>
    </div>
      {/foreach}
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