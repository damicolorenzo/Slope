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

  .form-container h1 {
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
  }

  button {
  padding: 10px 15px;
  border: 1px solid #000;
  border-radius: 3px;
  background-color: #fff;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #ddd;
}

.structures {
    font-family: Arial, sans-serif;
    margin: 0;
    padding-top: 20px;
    background-color: #f0f0f0;
    justify-content: center;
}

.structure-cards-container {
  display: flex;
  flex-direction: column;
  gap: 20px; /* Distanza tra le card */
  margin-top: 20px;
}

.card {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.skipass-info {
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* Allinea il testo a sinistra */
}

.admin-filter-container {
  margin: 40px auto;
  padding: 30px;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.admin-filter-container h2 {
  margin-bottom: 20px;
  font-size: 1.5rem;
}

.filters {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 15px;
}

.filters input[type="text"] {
  padding: 10px 15px;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  min-width: 200px;
  transition: border-color 0.3s;
}

.filters input[type="text"]:focus {
  border-color: #ff7a45;
  outline: none;
}

.edit {
  color: green;
  border-color: green;
}

.delete {
  color: red;
  border-color: red;
}
</style>
</head>

<body class="starter-page-page">

  <header id="header-admin" class="header-admin sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Slope Admin</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/Admin/dashboard">Dashboard</a></li>
            <li><a href="/Admin/logout">LogOut</a></li>
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
        <div class="admin-filter-container">
          <h2>Filtra template skipass</h2>
          <div class="filters">
            <form class="search-form" action="/Admin/searchSkipassTemplate" method="POST">
              <input type="text" id="description" name="description" placeholder="Descrizione">
              <input type="text" id="period" name="period" placeholder="Periodo">
              <input type="text" id="type" name="type" placeholder="Tipologia">
              <div class="button-container">
              <button type="submit">Filtra</button>
              </div>
            </form>
          </div>
        </div>

        {if count($skipassTemps) > 0}
          <div class="structures">
            <div class="structure-cards-container">
            {foreach from=$skipassTemps item=i}
              <div class="card">
                <div class="skippass-info">
                    <p>Descrizione: {$i->getDescription()}</p>
                    <p>Durata: {$i->getPeriod()}</p>
                    <p>Tipologia: {$i->getType()}</p>
                </div>
                <div class="action-buttons">
                  <form action="/Admin/modifySkipassTemp" method="POST">
                    <button type="submit" name="idSkipassTemp" id="idSkipassTemp" value={$i->getIdSkipassTemplate()} class="edit">Modifica</button>
                  </form>
                  <form action="/Admin/deleteSkipassTemp" method="POST">
                    <button type="submit" name="idSkipassTemp" id="idSkipassTemp" value={$i->getIdSkipassTemplate()} class="delete">Elimina</button>
                  </form>
                </div>
              </div>
            {/foreach}
            </div>
          </div>
        {/if}
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