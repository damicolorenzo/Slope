<?php
/* Smarty version 3.1.33, created on 2025-06-24 11:55:10
  from 'C:\xampp\htdocs\Slope\libs\Smarty\templates\admin-searchStructure.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_685a75fe7e9cd4_70271749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '095ce95657e04319aef1dadc2f03b90f992f7389' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Slope\\libs\\Smarty\\templates\\admin-searchStructure.tpl',
      1 => 1750758830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685a75fe7e9cd4_70271749 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Modifica strutture</title>

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

        <div class="form-container searchStructures">
          <div class="admin-filter-container">
            <h2>Filtra Strutture</h2>
            <div class="filters">
              <form class="search-form" action="/Slope/SearchAdmin/searchStructures" method="POST">
                <input type="text" id="nameSkiFacility" name="nameSkiFacility" placeholder="Nome impianto">
                <input type="text" id="nameSkiRun" name="nameSkiRun" placeholder="Nome pista">
                <input type="text" id="nameLiftStructure" name="nameLiftStructure" placeholder="Nome risalita">
                <div class="button-container">
                  <button type="submit">Filtra</button>
                </div>
              </form>
            </div>
          </div>

          <?php if (count($_smarty_tpl->tpl_vars['objects']->value) > 0) {?>
            <div class="structures">
              <div class="structure-columns">
                <div class="structure-column">
                <h2>Impianti</h2>
                <div class="structure-cards-container">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['objects']->value['skiFacilities'], 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                    <div class="card">
                      <div class="user-info">
                        <p>Nome: <?php echo $_smarty_tpl->tpl_vars['element']->value->getName();?>
</p>
                        <?php if ($_smarty_tpl->tpl_vars['element']->value->getStatus()) {?>
                        <p>Stato: Aperto</p>
                        <?php } else { ?>
                        <p>Stato: Chiuso</p>
                        <?php }?>
                        <p>Descrizione: <?php echo $_smarty_tpl->tpl_vars['element']->value->getDescription();?>
</p>
                      </div>
                      <div class="action-buttons">
                        <form class="search-form" action="/Slope/ModifyAdmin/modifySkiFacility" method="POST">
                          <button type="submit" name="idSkiFacility" value=<?php echo $_smarty_tpl->tpl_vars['element']->value->getIdSkiFacility();?>
 class="edit">Modifica</button>
                        </form>
                        <form class="search-form" action="/Slope/DeleteAdmin/deleteSkiFacility" method="POST">
                          <button type="submit" name="idSkiFacility" value=<?php echo $_smarty_tpl->tpl_vars['element']->value->getIdSkiFacility();?>
 class="delete">Elimina</button>
                        </form>
                      </div>
                    </div>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
                </div>
              <div class="structure-column">
              <h2>Piste</h2>
              <div class="structure-cards-container">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['objects']->value['skiRun'], 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>
                  <div class="card">
                    <div class="user-info">
                      <p>Nome: <?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getName();?>
</p>
                      <p>Tipologia: <?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getType();?>
</p>
                      <?php if ($_smarty_tpl->tpl_vars['element']->value[0]->getStatus()) {?>
                      <p>Stato: Aperto</p>
                      <?php } else { ?>
                      <p>Stato: Chiuso</p>
                      <?php }?>
                      <p>Impianto di riferimento: <?php echo $_smarty_tpl->tpl_vars['element']->value[1];?>
</p>
                    </div>
                    <div class="action-buttons">
                      <form class="search-form" action="/Slope/ModifyAdmin/modifySkiRun" method="POST">
                        <button type="submit" name="idSkiRun" value=<?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getIdSkiRun();?>
 class="edit">Modifica</button>
                      </form>
                      <form class="search-form" action="/Slope/DeleteAdmin/deleteSkiRun" method="POST">
                        <button type="submit" name="idSkiRun" value=<?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getIdSkiRun();?>
 class="delete">Elimina</button>
                      </form>
                    </div>
                  </div> 
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              </div>
              <div class="structure-column">
              <h2>Risalite</h2>
              <div class="structure-cards-container">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['objects']->value['liftStructure'], 'element');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
?>  
                  <div class="card">
                    <div class="user-info">
                      <p>Nome: <?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getName();?>
</p>
                      <p>Tipologia: <?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getType();?>
</p>
                      <?php if ($_smarty_tpl->tpl_vars['element']->value[0]->getStatus()) {?>
                      <p>Stato: Aperto</p>
                      <?php } else { ?>
                      <p>Stato: Chiuso</p>
                      <?php }?>
                      <p>Sedute: <?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getSeats();?>
</p>
                      <p>Impianto di riferimento: <?php echo $_smarty_tpl->tpl_vars['element']->value[1];?>
</p>
                    </div>
                    <div class="action-buttons">
                      <form class="search-form" action="/Slope/ModifyAdmin/modifyLiftStructure" method="POST">
                        <button type="submit" name="idLift" value=<?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getIdLift();?>
 class="edit">Modifica</button>
                      </form>
                      <form class="search-form" action="/Slope/DeleteAdmin/deleteLiftStructure" method="POST">
                        <button type="submit" name="idLift" value=<?php echo $_smarty_tpl->tpl_vars['element']->value[0]->getIdLift();?>
 class="delete">Elimina</button>
                      </form>
                    </div>
                  </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>
              </div>
            </div>
            </div>
          <?php }?>
        </div>
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
