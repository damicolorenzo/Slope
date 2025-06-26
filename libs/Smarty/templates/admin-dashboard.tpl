<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard</title>

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
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>

/* Layout base */
.admin-dashboard .layout {
  display: flex;
  gap: 30px;
  margin-top: 30px;
  flex-wrap: wrap;
}

/* Sidebar */
.admin-dashboard .layout .sidebar-wrapper {
  position: relative;
}

.admin-dashboard .layout .sidebar-wrapper .dashboard {
  background: linear-gradient(135deg, #e9f0f8, #ffffff);
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
  display: flex;
  flex-direction: column;
  width: 250px;
  transition: all 0.3s ease;
}

.admin-dashboard .layout .sidebar-wrapper .dashboard a {
  margin-bottom: 12px;
  padding: 10px 16px;
  font-size: 15px;
  font-weight: 500;
  text-decoration: none;
  color: #2c3e50;
  background-color: #ffffff;
  border-radius: 12px;
  transition: all 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.admin-dashboard .layout .sidebar-wrapper .dashboard a:hover {
  background-color: #4682B4;
  color: #ffffff;
  transform: translateY(-2px);
}

/* Main content area */
.admin-dashboard .layout .content {
  flex-grow: 1;
  min-width: 300px;
}

.admin-dashboard .layout .content h1 {
  text-align: center;
  font-size: 30px;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 24px;
}

.admin-dashboard .layout .controls {
  text-align: center;
  margin-bottom: 24px;
}

.admin-dashboard .layout .controls label {
  font-size: 16px;
  margin-right: 10px;
  color: #334155;
}

.admin-dashboard .layout .controls input[type="month"] {
  padding: 10px 14px;
  font-size: 16px;
  border-radius: 10px;
  border: 1px solid #cbd5e1;
  box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}

/* Chart and Table */
.admin-dashboard .layout .content .chart-container {
  width: 100%;
  background: #ffffff;
  padding: 24px;
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  margin-bottom: 30px;
  transition: box-shadow 0.3s ease;
}

.admin-dashboard .layout .content .chart-container:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.admin-dashboard .layout .content table {
  width: 100%;
  border-collapse: collapse;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
}

.admin-dashboard .layout .content th, td {
  padding: 16px 20px;
  text-align: center;
  border-bottom: 1px solid #f1f5f9;
}

.admin-dashboard .layout .content th {
  background-color: #4682B4;
  color: white;
  font-weight: 600;
}

/* Responsive layout */
@media (max-width: 768px) {
  .admin-dashboard .layout {
    flex-direction: column;
  }

  .admin-dashboard .layout .sidebar-wrapper .dashboard {
    width: 100%;
    margin-bottom: 20px;
  }

  .admin-dashboard .layout .sidebar-wrapper .dashboard a {
    padding: 14px;
    font-size: 16px;
  }

  .admin-dashboard .layout .content {
    width: 100%;
  }

  .admin-dashboard .layout .controls .chart-container, 
  .admin-dashboard .layout .controls table {
    width: 100%;
  }

  .admin-dashboard .layout .controls {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .admin-dashboard .layout input[type="month"] {
    width: 100%;
    margin-top: 10px;
  }
}

</style>
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
      <div class="container admin-dashboard" data-aos="fade-up">
        <div class="layout">
          
          <!-- Sidebar + Hamburger Toggle -->
          <div class="sidebar-wrapper">
            <nav class="dashboard" id="sidebar">
              <a href="/Slope/AddAdmin/addSkiRun">Aggiungi dati pista</a>
              <a href="/Slope/AddAdmin/addSkiFacility">Aggiungi dati impianto</a>
              <a href="/Slope/AddAdmin/addLiftStructure">Aggiungi dati risalita</a>
              <a href="/Slope/AddAdmin/addSkipassTemplate">Aggiungi template skipass</a>
              <a href="/Slope/AddAdmin/addInsuranceTemplate">Aggiungi template assicurazione</a>
              <a href="/Slope/AddAdmin/addSubscription">Aggiungi template abbonamento</a>
              <a href="/Slope/AddAdmin/addSkipassObj">Aggiungi oggetto skipass</a>
              <a href="/Slope/SearchAdmin/searchStructures">Modifica dati pista/impianto/risalita</a>
              <a href="/Slope/SearchAdmin/searchSkipassTemplate">Modifica template skipass</a>
              <a href="/Slope/SearchAdmin/searchInsuranceTemplate">Modifica template assicurazione</a>
              <a href="/Slope/SearchAdmin/searchSubscriptionTemplate">Modifica template abbonamento</a>
              <a href="/Slope/SearchAdmin/searchSkipassObjs">Modifica oggetto skipass</a>
              <a href="/Slope/ModifyAdmin/modifySkiFacilityImage">Modifica immagini impianto</a>
              <a href="/Slope/SearchAdmin/searchUsers">Modifica dati utente</a>
              <a href="/Slope/SearchAdmin/searchSkipassBooking">Modifica prenotazione skipass utente</a>
              <a href="/Slope/ModifyAdmin/modifyLandingPage">Modifica interfaccia</a>
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
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/aos/aos.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="https://localhost/Slope/libs/Smarty/day/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="https://localhost/Slope/libs/Smarty/day/assets/js/main.js"></script>

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
    'Roccaraso': '#4682B4',
    'Ovindoli': '#FF7F50',
    //'Passo Lanciano - Majelletta': 'rgb(138, 0, 156)'
    //'Campo Imperatore': 'rgb(75, 199, 91)'
    //'Campo Felice': 'rgb(202, 172, 0)'
    //'Prati di Tivo': 'rgb(173, 27, 27)'
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
        '#4682B4',  // Abbonati
        '#FF7F50'   // Non abbonati
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