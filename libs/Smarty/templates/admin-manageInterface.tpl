<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Modifica interfaccia</title>

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

  <header id="header-admin" class="header-admin sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/Slope" class="logo d-flex align-items-center">
          <h1 class="sitename">Slope Admin</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/Slope/Admin/dashboard">Dashboard</a></li>
            <li><a href="/Slope/Admin/logout">LogOut</a></li>
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

        <div class="form-container manageInterface">
          <section class="block">Head bar</section>

          <section class="block">
            <p>Image 1</p>
            {if $image1}
            <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                {foreach from=$image1 item=i}
                  <img id="imagePreview" src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img" >
                {/foreach}
            </div>
            {/if}
            <form action="/Slope/AddAdmin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
              <input type="hidden" name="idImage" id="idImage" value="1">
              <button class="edit-button" type="submit">Modifica immagine</button>
            </form>
          </section>

          <section class="block">About us</section>

          <section class="block">
            <div class="half">Description</div>
          </section>
          <section class="block">
              <p>Image 2</p>
              {if $image2}
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                {foreach from=$image2 item=i}
                  <img id="imagePreview" src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img" >
                {/foreach}
              </div>
              {/if}
            <form action="/Slope/AddAdmin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
              <input type="hidden" name="idImage" id="idImage" value="2">
              <button class="edit-button" type="submit">Modifica immagine</button>
            </form>
          </section>

          <section class="block">Dove sciare</section>
          <section class="block">Impianti</section>
          <section class="block">Servizi</section>
          <section class="block">Servizi</section>
          <section class="block">Pricing</section>
          <section class="block">Prezzi</section>
          <section class="block">Team</section>

          <section class="block">
            <div class="foto-blocks">
            <div class="foto-block">
              <p>Foto 1</p>
              {if $image3}
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                {foreach from=$image3 item=i}
                  <img id="imagePreview" src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img" >
                {/foreach}
              </div>
              {/if}
              <form action="/Slope/AddAdmin/addImageLandingPage" enctype="multipart/form-data" method="POST">
              <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="id" id="id" value="3">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
            <div class="foto-block">
              <p>Foto 2</p>
              {if $image4}
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                {foreach from=$image4 item=i}
                  <img id="imagePreview" src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img" >
                {/foreach}
              </div>
              {/if}
              <form action="/Slope/AddAdmin/addImageLandingPage" enctype="multipart/form-data" method="POST">
                <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="id" id="id" value="4">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
            <div class="foto-block">
              <p>Foto 3</p>
              {if $image5}
              <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                {foreach from=$image5 item=i}
                  <img id="imagePreview" src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img" >
                {/foreach}
              </div>
              {/if}
              <form action="/Slope/AddAdmin/addImageLandingPage" enctype="multipart/form-data" method="POST">
                <input type="file" name="image" id="image" multiple>
                <input type="hidden" name="id" id="id" value="5">
                <button class="edit-button" type="submit">Modifica immagine</button>
              </form>
            </div>
            </div>
          </section>

          <section class="block">Contatti</section>
        </div>

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