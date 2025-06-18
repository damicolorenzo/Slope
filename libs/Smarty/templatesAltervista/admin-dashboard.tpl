<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

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
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="starter-page-page">

  <header id="header-admin" class="header-admin sticky-top">
    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
          <h1 class="sitename">Slope Admin</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
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
      <div class="container admin-dashboard" data-aos="fade-up">
        <div class="layout">
          
          <!-- Sidebar + Hamburger Toggle -->
          <div class="sidebar-wrapper">
            <nav class="dashboard" id="sidebar">
              <a href="/Admin/addSkiRun">Aggiungi dati pista</a>
              <a href="/Admin/addSkiFacility">Aggiungi dati impianto</a>
              <a href="/Admin/addLiftStructure">Aggiungi dati risalita</a>
              <a href="/Admin/addSkipassTemplate">Aggiungi template skipass</a>
              <a href="/Admin/addInsuranceTemplate">Aggiungi template assicurazione</a>
              <a href="/Admin/addSubscription">Aggiungi template abbonamento</a>
              <a href="/Admin/addSkipassObj">Aggiungi oggetto skipass</a>
              <a href="/Admin/searchStructures">Modifica dati pista/impianto/risalita</a>
              <a href="/Admin/searchSkipassTemplate">Modifica template skipass</a>
              <a href="/Admin/searchInsuranceTemplate">Modifica template assicurazione</a>
              <a href="/Admin/searchSubscriptionTemplate">Modifica template abbonamento</a>
              <a href="/Admin/searchSkipassObjs">Modifica oggetto skipass</a>
              <a href="/Admin/modifySkiFacilityImage">Modifica immagini impianto</a>
              <a href="/Admin/searchUsers">Modifica dati utente</a>
              <a href="/Admin/searchSkipassBooking">Modifica prenotazione skipass utente</a>
              <a href="/Admin/modifyLandingPage">Modifica interfaccia</a>
            </nav>
          </div>

          <!-- Main Content -->
          <div class="content">
            <h1>Statistiche Prenotazioni</h1>
            <div class="controls">
              <label for="mese">Seleziona mese:</label>
              <input type="month" id="mese" />
            </div>
            <div class="chart-container">
              <canvas id="graficoPrenotazioni" width="400" height="200"></canvas>
            </div>
            <div class="chart-container">
              <canvas id="graficoUtentiPie" width="300" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- /Starter Section Section -->

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

<script>
const ctx = document.getElementById('graficoPrenotazioni').getContext('2d');
const ctxPie = document.getElementById('graficoUtentiPie').getContext('2d');

// Ottieni il mese corrente
const bookingsData = {$map};
const oggi = new Date();
const meseDefault = oggi.toISOString().slice(0, 7);
document.getElementById('mese').value = meseDefault;

function generaDataset(mese) {
  const meseData = bookingsData[mese] || {};
  const labels = Object.keys(meseData);
  const values = Object.values(meseData);

  const colors = {
    'Roccaraso': 'rgba(54, 162, 235, 0.7)',
    'Ovindoli': 'rgba(255, 159, 64, 0.7)',
    // aggiungi altri impianti qui se necessario
  };

  return {
    labels: labels,
    datasets: [{
      label: 'Prenotazioni per impianto',
      data: values,
      backgroundColor: labels.map(name => colors[name] || 'rgba(153, 102, 255, 0.7)'),
      borderColor: 'rgba(255, 255, 255, 1)',
      borderWidth: 2
    }]
  };
}

let graficoPrenotazioni = new Chart(ctx, {
  type: 'bar',
  data: generaDataset(meseDefault),
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Prenotazioni per impianto nel mese selezionato'
      },
      legend: {
        display: false
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

document.getElementById('mese').addEventListener('change', function () {
  const nuovoMese = this.value;
  graficoPrenotazioni.data = generaDataset(nuovoMese);
  graficoPrenotazioni.update();
});

const graficoUtentiPie = new Chart(ctxPie, {
  type: 'pie',
  data: {
    labels: {$etichettePie},
    datasets: [{
      data:  {$valoriPie},
      backgroundColor: [
        'rgba(54, 162, 235, 0.7)',  // Abbonati
        'rgba(255, 99, 132, 0.7)'   // Non abbonati
      ],
      borderColor: [
        'rgba(255, 255, 255, 1)',
        'rgba(255, 255, 255, 1)'
      ],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: 'Distribuzione Utenti'
      },
      legend: {
        position: 'bottom'
      }
    }
  }
});
</script>
</body>

</html>