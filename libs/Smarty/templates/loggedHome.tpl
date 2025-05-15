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
.card-impianto {
  display: flex;
  flex-direction: row;  /* Ripristina il layout orizzontale */
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 100%;  /* La card occupa tutta la larghezza della pagina */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.left {
  width: 40%;  /* L'immagine occupa il 40% della larghezza della card */
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 16px;
  background-color: #f8f8f8; /* Colore di sfondo per l'immagine */
}

.left .impianto-img {
  width: 100%; 
  overflow: hidden;
  display: flex;
  justify-content: center;
}

.left .impianto-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;  /* L'immagine si adatta senza distorsioni */
} 

.right {
  width: 60%;  /* La parte dei dettagli occupa il restante 60% della larghezza */
  padding: 16px;
  background-color: #fff;
}

.right-container{
  margin: 5% 5% 5% 5%;
}

.impianto {
  text-align: center;
}

.impianto h3 {
  font-size: 22px;
  color: #333;
  margin-bottom: 10px;
}

.dettagli-impianto {
  display: flex;
  margin: 5% 0% 5% 0%;
}

.dettagli-impianto h4 {
  margin-top: 0;
  font-size: 18px;
  color: #666;
}

.dettagli-impianto .piste {
  width: 20%;
  display: flex;
  flex-direction: column;
  gap: 6px;
  margin-bottom: 10px;
}

.impianti {
  margin-left: 10%;
}

.pista {
  padding: 6px 12px;
  border-radius: 6px;
  color: #fff;
  font-size: 14px;
  display: flex;
  justify-content: space-between;
}

.pista.rossa {
  background-color: #e74c3c; /* Colore rosso per piste rosse */
}

.pista.nera {
  background-color: #2c3e50; /* Colore nero per piste nere */
}

.pista.blu {
  background-color: #3498db; /* Colore blu per piste blu */
}

.pista.verde {
  background-color: #2ecc71; /* Colore verde per piste verdi */
}

.dettagli-impianto p {
  margin: 4px 0;
  font-size: 14px;
  color: #444;
}

.dettagli-impianto span {
  font-weight: bold;
}

.status {
  padding: 6px 12px;
  border-radius: 4px;
  color: #fff;
  font-size: 14px;
}

.status.aperto {
  background-color: #4caf50; /* Verde per aperto */
}

.status.chiuso {
  background-color: #f44336; /* Rosso per chiuso */
}

.search-form {
  display: flex;
  flex-direction: column; /* La form è disposta in colonna */
  align-items: center;
}

.btn-submit {
  display: block;
  width: 100%;
  padding: 12px;
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  background-color: #4682B4;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-submit:hover {
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

    <!-- Page Title -->
    <!-- <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Starter Page</li>
          </ol>
        </nav>
        <h1>Starter Page</h1>
      </div>
    </div> --><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section"> 
      <div class="container" data-aos="fade-up">

        {foreach from=$map item=i} 
          <form class="search-form" action="/Slope/User/skiFacilityDetails" method="POST">
          <div class="card-impianto">
            <div class="left">
              <div class="impianto-img">
              {if count($i[3]) > 1}
              <div class="carousel-track">
                {foreach from=$i[3] item=e} 
                  <img class="imagePreview" src="data:{$e->getType()};base64,{$e->getEncodedData()}" >
                {/foreach}
              </div>
              {else}
              {foreach from=$i[3] item=e} 
                <img class="imagePreview" src="data:{$e->getType()};base64,{$e->getEncodedData()}" >
              {/foreach}
              {/if}
              </div>
            </div>
            <div class="right">
              <div class="right-container">
                <h3>{$i[0]}</h3>
                <div class="dettagli-impianto">
                  <div class="piste">
                    <h4>Dettagli piste</h4> 
                    {foreach from=$i[1] item=e}  
                      {if $e['type'] == blu}
                      <div class="pista blu">Blu: <span>{$e['CNT']}</span></div>
                      {/if}
                      {if $e['type'] == rossa}
                      <div class="pista rossa">Rosse: <span>{$e['CNT']}</span></div>
                      {/if}
                      {if $e['type'] == nera}
                      <div class="pista nera">Nere: <span>{$e['CNT']}</span></div>
                      {/if}
                      {if $e['type'] == verde}
                      <div class="pista verde">Verdi: <span>{$e['CNT']}</span></div>
                      {/if}
                    {/foreach}
                  </div>
                  <div class="impianti">
                  <h4>Impianti di risalita:</h4>
                  {foreach from=$i[2] item=f}
                      <div>{Ucwords($f['type'])}: <span>{$f['CNT']}</span></div>
                  {/foreach}
                  </div>
                  
                </div>
                <p>Stato impianto: <span class="status aperto">aperto</span></p>
                <button class="btn-submit" type="submit" name="nameSkiFacility" value="{$i[0]}">Esplora</button>
              </div>
            </div>
          </div>
          
          <form>
        {/foreach}

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