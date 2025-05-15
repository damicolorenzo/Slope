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

  .login-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
}

  .login-form {
  background-color: white;
  padding: 60px 50px;
  border-radius: 16px;
  width: 100%;
}

.login-form h2 {
  font-size: 32px;
  margin-bottom: 36px;
  color:rgb(0, 0, 0);
}

.login-form label {
  display: block;
  margin: 18px 0 10px;
  font-size: 18px;
  color:rgb(0, 0, 0);
}

.login-form input {
  width: 100%;
  padding: 16px;
  margin-bottom: 24px;
  font-size: 18px;
  border: 1px solid #ccc;
  border-radius: 10px;
}

.login-form button {
  width: 100%;
  padding: 18px;
  background-color: #FF7F50;
  color: white;
  font-size: 20px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.login-form button:hover {
  background: color-mix(in srgb, var(--accent-color), transparent 20%);
}

@media screen and (max-width: 600px) {
  .form_login-container {
    padding: 30px 20px;
    border-radius: 10px;
    box-shadow: none;
  }

  .register-form input,
  .register-form button {
    font-size: 16px;
    padding: 12px;
  }

  .register-form h2 {
    font-size: 24px;
  }

  .register-form label {
    font-size: 15px;
  }
}
  </style>
</head>

<body class="starter-page-page">

  <header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> --><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 45 45" fill="none">
            <path d="M26.2409 33.633L31.3639 35.498C33.0209 36.101 34.8379 35.375 35.6459 33.864L36.5919 34.209C35.6189 36.177 33.3389 37.17 31.2169 36.504L31.0169 36.436L24.2609 33.978L24.2519 33.974L24.2429 33.97L7.99988 28.058L8.34188 27.118L26.2409 33.633Z" fill="#3C3C3C"/>
            <path d="M26.2409 33.633L31.3639 35.498C33.0209 36.101 34.8379 35.375 35.6459 33.864L36.5919 34.209C35.6189 36.177 33.3389 37.17 31.2169 36.504L31.0169 36.436L24.2609 33.978L24.2519 33.974L24.2429 33.97L7.99988 28.058L8.34188 27.118L26.2409 33.633Z" stroke="#3C3C3C"/>
            <path d="M24.8639 32.733L29.2689 26.781C29.6909 26.212 29.6519 25.434 29.2009 24.91L29.1899 24.897L29.1789 24.886L29.0899 24.796L29.0789 24.785L29.0679 24.774L26.3989 22.371C26.2339 22.221 26.1889 21.984 26.2809 21.787L26.3259 21.71L29.0999 17.546L30.2979 18.345V18.356L30.3019 18.388L30.3339 18.634L30.3349 18.647C30.3479 18.726 30.3609 18.801 30.3759 18.867C30.6079 19.873 31.1419 20.663 32.0179 21.196C32.8339 21.691 33.9089 21.941 35.2339 21.99V22.99C32.2709 22.883 30.4319 21.806 29.6609 19.916L29.3049 19.044L28.7819 19.828L27.6299 21.557L27.3899 21.916L27.7109 22.207L29.7369 24.031C30.6519 24.855 30.8249 26.216 30.1689 27.238L30.0689 27.382L25.6179 33.294M20.6019 31.208L23.8249 26.992L24.1149 26.613L23.7499 26.307L20.7489 23.774C20.2659 23.366 19.9949 22.788 19.9649 22.19L21.0829 22.61C21.1299 22.705 21.1889 22.796 21.2599 22.878L21.2729 22.893L21.2869 22.906L21.3659 22.983L21.3799 22.998L21.3939 23.009L25.1239 26.158C25.3089 26.313 25.3529 26.575 25.2389 26.781L25.1899 26.854L21.3149 31.759M17.6749 16.692L18.0579 16.835L18.2739 16.49L19.1509 15.089C19.3119 14.832 19.4899 14.586 19.6849 14.354C21.5839 12.092 24.6969 11.449 27.2719 12.578L28.1049 12.944L27.9679 12.046C27.8489 11.269 27.9909 10.449 28.4269 9.72199C29.4229 8.06499 31.5729 7.52899 33.2299 8.52399C34.8869 9.51999 35.4229 11.669 34.4279 13.326C33.9679 14.09 33.2649 14.615 32.4759 14.863L32.3149 14.914L32.2179 15.052L31.7529 15.709L30.9089 15.147L31.6679 14.013C32.4279 13.939 33.1459 13.517 33.5699 12.811C34.2809 11.628 33.8989 10.093 32.7149 9.38199C31.5319 8.66999 29.9959 9.05299 29.2849 10.237C28.8629 10.938 28.8259 11.763 29.1109 12.466L28.0629 14.21C25.7389 12.381 22.3659 12.717 20.4509 14.998C20.3409 15.129 20.2369 15.264 20.1399 15.404L20.1329 15.414L20.0049 15.61L19.9989 15.619L19.3379 16.677L19.0129 17.194L19.5859 17.41" fill="#3C3C3C"/>
            <path d="M24.8639 32.733L29.2689 26.781C29.6909 26.212 29.6519 25.434 29.2009 24.91L29.1899 24.897L29.1789 24.886L29.0899 24.796L29.0789 24.785L29.0679 24.774L26.3989 22.371C26.2339 22.221 26.1889 21.984 26.2809 21.787L26.3259 21.71L29.0999 17.546L30.2979 18.345V18.356L30.3019 18.388L30.3339 18.634L30.3349 18.647C30.3479 18.726 30.3609 18.801 30.3759 18.867C30.6079 19.873 31.1419 20.663 32.0179 21.196C32.8339 21.691 33.9089 21.941 35.2339 21.99V22.99C32.2709 22.883 30.4319 21.806 29.6609 19.916L29.3049 19.044L28.7819 19.828L27.6299 21.557L27.3899 21.916L27.7109 22.207L29.7369 24.031C30.6519 24.855 30.8249 26.216 30.1689 27.238L30.0689 27.382L25.6179 33.294M20.6019 31.208L23.8249 26.992L24.1149 26.613L23.7499 26.307L20.7489 23.774C20.2659 23.366 19.9949 22.788 19.9649 22.19L21.0829 22.61C21.1299 22.705 21.1889 22.796 21.2599 22.878L21.2729 22.893L21.2869 22.906L21.3659 22.983L21.3799 22.998L21.3939 23.009L25.1239 26.158C25.3089 26.313 25.3529 26.575 25.2389 26.781L25.1899 26.854L21.3149 31.759M17.6749 16.692L18.0579 16.835L18.2739 16.49L19.1509 15.089C19.3119 14.832 19.4899 14.586 19.6849 14.354C21.5839 12.092 24.6969 11.449 27.2719 12.578L28.1049 12.944L27.9679 12.046C27.8489 11.269 27.9909 10.449 28.4269 9.72199C29.4229 8.06499 31.5729 7.52899 33.2299 8.52399C34.8869 9.51999 35.4229 11.669 34.4279 13.326C33.9679 14.09 33.2649 14.615 32.4759 14.863L32.3149 14.914L32.2179 15.052L31.7529 15.709L30.9089 15.147L31.6679 14.013C32.4279 13.939 33.1459 13.517 33.5699 12.811C34.2809 11.628 33.8989 10.093 32.7149 9.38199C31.5319 8.66999 29.9959 9.05299 29.2849 10.237C28.8629 10.938 28.8259 11.763 29.1109 12.466L28.0629 14.21C25.7389 12.381 22.3659 12.717 20.4509 14.998C20.3409 15.129 20.2369 15.264 20.1399 15.404L20.1329 15.414L20.0049 15.61L19.9989 15.619L19.3379 16.677L19.0129 17.194L19.5859 17.41" stroke="#3C3C3C"/>
            <path d="M8.60785 14.061L24.6138 20.065" stroke="#3C3C3C" stroke-width="2"/>
            </svg>
          <h1 class="sitename">Slope</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <!-- <li><a href="#hero">Home</a></li>
            <li><a href="#about">Prenota</a></li>
            <li><a href="#services">Visualizza prenotazioni</a></li>
            <li class="dropdown"><a href="#"><span>Aggiornamenti</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a> -->
              <ul>
                <!-- <li><a href="#">Piste</a></li>
                <li><a href="#">Impianti</a></li>
                <li><a href="#">Web</a></li> -->
              </ul>
            </li>
            <li><a href="/">Home</a></li>
            <li><a href="/User/login">Login</a></li>
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

      {if $exist == false}
      <div class="login-wrapper">
        <div class="col-lg-4 col-md-6 card aos-init aos-animate" data-aos="fade-up">
            
            <form class="login-form" action="/User/checkRegistration" method="POST">
                <h2>Registrazione</h2>
                
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="{$name}" required>
                
                <label for="surname">Cognome</label>
                <input type="text" id="surname" name="surname" value="{$surname}" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{$email}" required>
                
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{$username}" required>
                
                <label for="phoneNumber">Numero di telefono</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" value="{$phoneNumber}" required>
                {if $phoneError == true}
                <label>Inserire numero del tipo +39NUMERO_DI_TELEFONO</label>
                {/if}
                
                <label for="birthDate">Data di nascita</label>
                <input type="date" id="birthDate" name="birthDate" min="1900-01-01" value="{$birthDate}" required>
                {if $dateError == true}
                <label>Inserire una data compresa tra 01-01-1900 e oggi</label>
                {/if}

                <label for="password-register">Password</label>
                <input type="password" id="password" name="password" required>
                {if $passwordError == true}
                <label>Lunghezza minima 8 CARATTERI, lettere maiuscole/minuscole, numeri, almeno un carattere speciale</label>
                {/if}
                
                <button type="submit">Registrati</button>
            </form>
        </div>
      </div>
      {/if}
      {if $exist == true}
      <div class="container" data-aos="fade-up">
        <h1>L'utente è già presente nel database</h1>
        <h2>Effettua l'accesso <a href="/User/login">qui</a></h2>
      </div>
      {/if}

    </section><!-- /Starter Section Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about">
            <a href="/" class="logo sitename">Slope</a>
            <div class="footer-contact pt-3">
              <p>Via Vetoio</p>
              <p>L'Aquila, AQ 67100</p>
              <p class="mt-3"><strong>Numero:</strong> <span>+39 123 456 7890</span></p>
              <p><strong>Email:</strong> <span>info@example.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Slope</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

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