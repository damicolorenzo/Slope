<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Slope</title>

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

<body class="index-page">

  <header id="header" class="header fixed-top">

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 45 45" fill="none">
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
            <li><a href="#hero" class="active">Home</a></li>
            <li><a href="#about">Conoscici</a></li>
            <li><a href="#cards">Dove Sciare</a></li>
            <li><a href="#services">Servizi</a></li>
            <li><a href="#pricing">Prezzi</a></li>
            <li><a href="#team">Team</a></li>
            <li><a href="#contact">Contatti</a></li>
            <li><a href="/Slope/User/login">LogIn</a></li>
            <li><a href="/Slope/User/registration">Registrati</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <!-- <img src="https://localhost/Slope/libs/Smarty/images/dog1.jpg" alt="" data-aos="fade-in"> -->
      <!-- <video src="libs/Smarty/images/4185213-uhd_4096_2160_24fps.mp4" loop></video> -->
       <div class="first-img">
        {if isset($image1)}
        {foreach from=$image1 item=i}
          <img src = "data:{$i->getType()};base64,{$i->getEncodedData()}" alt="" class="img-fluid">
        {/foreach}
        {else}
          <img src = "https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="" class="img-fluid">
        {/if}
      </div>
      

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Conoscici<br></span>
        <h2>Conoscici<br></h2>
        <p>Scopri tutte le informazioni utili per la tua giornata sulla neve</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
          {if isset($image1)}
          {foreach from=$image2 item=i}
            <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" class="img-fluid" alt="">
          {/foreach}
          {else}
            <img src = "https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="" class="img-fluid">
          {/if}
          </div>

          <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Cosa offriamo</h3>
            <p class="fst-italic">
              Verifica le condizioni delle piste e monitora le aperture in tempo reale.
            </p>
            <ul>
              <li><i class="bi bi-snow"></i> <span>Hai bisogno dello skipass o dell'attrezzatura?</span></li>
              <li><i class="bi bi-snow"></i> <span>Vuoi tutelarti ed acquistare un'assicurazione?</span></li>
              <li><i class="bi bi-snow"></i> <span>Vuoi rimanere al passo con opportunità e promozioni?</span></li>
            </ul>
            <p class="fst-italic">
              Qui trovi tutto ciò di cui hai bisogno
            </p>
            <a href="/Slope/User/login" class="read-more"><span>Scopri di più   </span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Cards Section -->
    <section id="cards" class="cards section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Dove Sciare</span>
        <h2>Dove Sciare</h2>
        <p>Scegli dove sciare tra i siti sciistici d'Abruzzo</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="cards">
          <div class="row no-gutters">
          
          {foreach from=$skiFacilities item=$i}
            <div class="col-lg-4 col-md-6 card img-overlay-box" data-aos="fade-up" data-aos-delay="100">
              {if isset($i[1])}
              {foreach from=$i[1] item=$e}
              <img src="data:{$e->getType()};base64,{$e->getEncodedData()}" alt="" class="bg-img">
              {/foreach}
              {else}
                <img src = "https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="" class="img-fluid">
              {/if}
              <div class="dark-overlay"></div>
              <div class="content">
                <h4>{$i[0]->getName()}</h4>
                <a href="/Slope/User/login" class="stretched-link"></a>
              </div>
            </div>
          {/foreach}
          
          </div>
        </div>
      </div>
    </section><!-- /Cards Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Servizi</span>
        <h2>Servizi</h2>
        <p>La nostra piattaforma web permette di monitorare diversi impianti sciistici in modo tale da poter organizzare una splendida giornata in montagna</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="bi bi-snow"></i>
              </div>
              <a href="/Slope/User/login" class="stretched-link">
                <h3>Monitoraggio impianti</h3>
              </a>
              <p>Consulta le condizioni odierne dei nostri comprensori sciistici</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-cash-stack"></i></i>
              </div>
              <a href="#pricing" class="stretched-link">
                <h3>Listino prezzi</h3>
              </a>
              <p>Consulta i prezzi e le opportunità</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-cart"></i>
              </div>
              <a href="https://www.opensnowmap.org/#map=12/14.017/41.819&b=snowmap&m=false&h=false" target="_blank" class="stretched-link">
                <h3>Mappe</h3>
              </a>
              <p>Dai un occhiata alle mappe degli impianti sciistici.</p>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>

    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <video autoplay muted loop playsinline class="background-video">
        <source src="https://localhost/Slope/libs/Smarty/images/4185213-uhd_4096_2160_24fps.mp4" type="video/mp4">
        Il tuo browser non supporta i video HTML5.
      </video>

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Pronto per la prossima discesa?</h3>
              <p>Consulta in tempo reale le condizioni delle piste e acquista il tuo skipass in pochi clic. Evita le code, risparmia tempo e goditi ogni momento sulla neve!</p>
              <a class="cta-btn" href="/Slope/User/login">Prenota il tuo Skipass</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
      
      <div class="choseSkiFacility-section">
        <form action="/Slope/User/home" method="POST" class="choseSkiFacility-form">
          <h2>Seleziona l'impianto e analizza i prezzi</h2>
          <div class="form-row">
            <div class="form-group">
              <label for="skiFacilities">Scegli un impianto:</label>
              <select name="skiFacilities" id="skiFacility" multiple size="5">
                {foreach from=$skiFacilities item=i}
                  <option value="{$i[0]->getName()}">{$i[0]->getName()}</option>
                {/foreach}
              </select>
            </div>
            <input type="submit" value="Visualizza selezione">
          </div>
        </form>
      </div>

      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-4 g-lg-0">
          {if count($skipassObj) > 0}
          {if isset($skipassObj[0])}
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>{$skipassObj[0]->getDescription()}</h3>
              <h4><sup>€</sup>{$skipassObj[0]->getValue()}<span></span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Il costo per l’utilizzo del servizio o prodotto è calcolato su base giornaliera.</span></li>
                <li><i class="bi bi-check"></i> <span>Ideale per chi ha bisogno di flessibilità e vuole pagare solo per i giorni effettivi di utilizzo.</span></li>
              </ul>
              <div class="text-center"><a href="/Slope/User/login" class="buy-btn">Acquista ora</a></div>
            </div>
          </div><!-- End Pricing Item -->
          {else} 
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Errore</h3>
              <h4><sup>€</sup>0<span></span></h4>
              <div class="text-center">...</div>
            </div>
          </div><!-- End Pricing Item -->
          {/if}
          {if isset($skipassObj[1])}
          <div class="col-lg-4 featured" data-aos="zoom-in" data-aos-delay="200">
            <div class="pricing-item">
              <h3>{$skipassObj[1]->getDescription()}</h3>
              <h4><sup>€</sup>{$skipassObj[1]->getValue()}<span></span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Tariffa conveniente per chi utilizza il servizio o prodotto per un’intera settimana.</span></li>
                <li><i class="bi bi-check"></i> <span>Perfetto per chi ha bisogno di un periodo medio di utilizzo, con un risparmio rispetto al prezzo giornaliero.</span></li>
              </ul>
              <div class="text-center"><a href="/Slope/User/login" class="buy-btn">Acquista ora</a></div>
            </div>
          </div><!-- End Pricing Item -->
          {else} 
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Errore</h3>
              <h4><sup>€</sup>0<span></span></h4>
              <div class="text-center">...</div>
            </div>
          </div><!-- End Pricing Item -->
          {/if}
          {if isset($skipassObj[2])}
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>{$skipassObj[2]->getDescription()}</h3>
              <h4><sup>€</sup>{$skipassObj[2]->getValue()}<span></span></h4>
              <ul>
                <li><i class="bi bi-check"></i> <span>Offerta vantaggiosa per chi prevede un utilizzo continuativo e prolungato.</span></li> 
                <li><i class="bi bi-check"></i> <span>Il prezzo mensile garantisce il massimo risparmio rispetto alle tariffe giornaliere o settimanali.</span></li>
              </ul>
              <div class="text-center"><a href="/Slope/User/login" class="buy-btn">Acquista ora</a></div>
            </div>
          </div><!-- End Pricing Item -->
          {else} 
          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-item">
              <h3>Errore</h3>
              <h4><sup>€</sup>0<span></span></h4>
              <div class="text-center">...</div>
            </div>
          </div><!-- End Pricing Item -->
          {/if}
        {else}
          <h3>Errore di caricamento dati</h3>
        {/if}
        </div>

      </div>

    </section><!-- /Pricing Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Team</span>
        <h2>Team</h2>
        <p>Trasformiamo idee in codice e codice in esperienze digitali.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              {if isset($image3)}
              {foreach from=$image3 item=i}
                <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" class="img-fluid" alt="">
              {/foreach}
              {else}
                <img src = "https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="" class="img-fluid">
              {/if}
              <div class="member-content">
                <h4>Andrea Esposito</h4>
                <span>Istruttore di sci</span>
                <p>
                  Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              {if isset($image4)}
              {foreach from=$image4 item=i}
                <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" class="img-fluid" alt="">
              {/foreach}
              {else}
                <img src = "https://localhost/Slope/libs/Smarty/images/istruttore_sci.jpg" alt="" class="img-fluid"> 
              {/if}
              <div class="member-content">
                <h4>Giordana Di Fabio</h4>
                <span>Istruttrice di snowboard</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              {if isset($image5)}
              {foreach from=$image5 item=i}
                <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" class="img-fluid" alt="">
              {/foreach}
              {else}
                <img src = "https://localhost/Slope/libs/Smarty/images/NotFound.jpg" alt="" class="img-fluid">
              {/if}
              <div class="member-content">
                <h4>Lorenzo D'Amico</h4>
                <span>Istruttore di sci alpinistico</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Contatti</span>
        <h2>Contatti</h2>
        <p>Puoi trovare tutti i nostri contatti qui</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Indirizzo</h3>
              <p>Via per dove, 10</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Chiamaci</h3>
              <p>+39 123 456 7890</p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Contattaci via mail</h3>
              <p>slope.website.mail@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d23961.936908620435!2d13.399999!3d42.349998!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13340f4f5b0b5a89%3A0x7a8a10d94772e0!2sL&#39;Aquila%2C%20Italy!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div><!-- End Google Maps -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-6 col-md-6">
          <div class="footer-about">
            <a href="index.html" class="logo sitename">Slope</a>
            <div class="footer-contact pt-3">
              <p>Via dalla strada, 1</p>
              <p>L'Aquila AQ 67100</p>
              <p class="mt-3"><strong>Telefono:</strong> <span>+39 123 456 7890</span></p>
              <p><strong>Email:</strong> <span>slope.website.mail@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 footer-links">
          <h4>Link utili</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Servizi</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-3 footer-links">
          <h4>I nostri servizi</h4>
          <ul>
            <li><a href="#services">Monitoraggio</a></li>
            <li><a href="#services">Mappe</a></li>
          </ul>
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