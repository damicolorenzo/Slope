<?php
/* Smarty version 3.1.33, created on 2025-05-15 14:21:41
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\showBookings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_6825dc552e1c06_18480847',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9646e996eb883e163a0100bddfc26918112a740' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\showBookings.tpl',
      1 => 1747311698,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6825dc552e1c06_18480847 (Smarty_Internal_Template $_smarty_tpl) {
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


      <div class="calendar-container">
        <h2>
          <form action="/Slope/User/showBookings" method="POST">
            <input type="hidden" name="month" value=<?php echo $_smarty_tpl->tpl_vars['prevMonth']->value;?>
>
            <input type="hidden" name="year" value=<?php echo $_smarty_tpl->tpl_vars['prevYear']->value;?>
>
            <button type="submit">&laquo;</button>
          </form>

          <?php echo $_smarty_tpl->tpl_vars['monthName']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['year']->value;?>


          <form action="/Slope/User/showBookings" method="POST">
            <input type="hidden" name="month" value=<?php echo $_smarty_tpl->tpl_vars['nextMonth']->value;?>
>
            <input type="hidden" name="year" value=<?php echo $_smarty_tpl->tpl_vars['nextYear']->value;?>
>
            <button type="submit">&raquo;</button>
          </form>
        </h2>

        <table>
          <tr>
            <th>Mon</th><th>Tue</th>
            <th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
          </tr>

          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['calendar']->value, 'week');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['week']->value) {
?>
            <tr>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['week']->value, 'day');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['day']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['day']->value) {?>
                  <?php if (in_array($_smarty_tpl->tpl_vars['day']->value,$_smarty_tpl->tpl_vars['bookedDates']->value)) {?> <!-- Controlla se il giorno è prenotato -->
                    <td class="booked"><?php echo $_smarty_tpl->tpl_vars['day']->value;?>
</td> <!-- Giorno prenotato con stile speciale -->
                  <?php } else { ?>
                    <td><?php echo $_smarty_tpl->tpl_vars['day']->value;?>
</td> <!-- Giorno normale -->
                  <?php }?>
                <?php }?>
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tr>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
      </div>


      <?php if (count($_smarty_tpl->tpl_vars['bookings']->value) > 0) {?>
      <h1>Dati prenotazione</h1>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bookings']->value, 'e');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['e']->value) {
?>
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
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getSurname();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getEmail();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getStartDate();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getPeriod();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getType();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getValue();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][1]->getName();?>
</td>
                    <?php if ($_smarty_tpl->tpl_vars['e']->value['bookings'][2] != array()) {?>
                    <td class="true"><img class="imagePreview" src="https://localhost/Slope/libs/Smarty/images/checked.png"></td>
                    <?php } else { ?>
                    <td><form action="/Slope/User/buyInsurance" method="POST"><input type="hidden" name="idSkipassBooking" value=<?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getIdSkipassBooking();?>
><button type="submit">Acquista</button></form></td>
                    <?php }?>
                    <form action="/Slope/User/modifySkipassBooking" method="POST"><td><input type="hidden" name="idSkipassBooking" value=<?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getIdSkipassBooking();?>
><button type="submit" class="btn-mod">Modifica</button></td></form>
                    <form action="/Slope/User/deleteSkipassBooking" method="POST"><td><input type="hidden" name="idSkipassBooking" value=<?php echo $_smarty_tpl->tpl_vars['e']->value['bookings'][0]->getIdSkipassBooking();?>
><button type="submit" class="btn-er">Elimina</button></td></form>
                </tr>
            </tbody>
        </table>
    </div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
      <label>Nessuna prenotazione effettuata</label>
      <?php }?>

    

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
