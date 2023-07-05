<!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>IBTP-MATADI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="vue/gabarit/img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/owl.carousel.css">
    <link rel="stylesheet" href="vue/gabarit/css/owl.theme.css">
    <link rel="stylesheet" href="vue/gabarit/css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/normalize.css">
    <link rel="stylesheet" href="vue/gabarit/css/datapicker/datepicker3.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/form/themesaller-forms.css">
    <!-- colorpicker CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/colorpicker/colorpicker.css">
    <!-- select2 CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/select2/select2.min.css">
    <!-- chosen CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/chosen/bootstrap-chosen.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="vue/gabarit/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="vue/gabarit/css/calendar/fullcalendar.print.min.css">    
    <!-- Chart CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/c3/c3.min.css">
    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/editor/select2.css">
    <link rel="stylesheet" href="vue/gabarit/css/editor/datetimepicker.css">
    <link rel="stylesheet" href="vue/gabarit/css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="vue/gabarit/css/editor/x-editor-style.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="vue/gabarit/css/data-table/bootstrap-editable.css">
    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="vue/gabarit/css/notifications/notifications.css">
    
    <!-- modals CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/modals.css">
    
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="vue/gabarit/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="vue/gabarit/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Header menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.php"><img class="main-logo" src="vue/gabarit/img/logo/logo.png" alt="" /></a>
                <strong><a href="index.php">IBTP/MATDI</a></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a href="index.php">
								               <span class="educate-icon educate-home icon-wrap"></span>
                              <span class="mini-click-non">TABLEAU DE BORD</span>
							              </a>
                        </li>
                        <?php
                        if ($_SESSION['module'] == 'Titulaire') {
                        ?>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">MES FICHES</span></a>
                            <ul class="submenu-angle list-promotion" aria-expanded="false">
                                <!--<li><a title="Add Courses" href="index.php?add_cours"><span class="mini-sub-pro">Ajouter</span></a></li>-->
                            </ul>
                        </li>
                        <?php
                        }elseif ($_SESSION['module'] == 'Etudiant') {
                        ?>
                        <li>
                            <a href="index.php?finance-etudiant"><span class="educate-icon educate-charts icon-wrap"></span> <span class="mini-click-non">MES FINANCES</span></a>
                        </li>

                        <?php
                        } elseif ($_SESSION['module'] == 'Coges') {
                        ?>
                        <li>
                            <a href="index.php?profile-admin=<?= $_SESSION['id'] ?>"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">PROFILE</span></a>
                        </li>

                        <?php
                        } elseif ($_SESSION['module'] == 'Operateur') {
                        ?>
                          <li>
                              <a href="index.php?profile-operateur=<?= $_SESSION['agent'] ?>"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">PROFILE</span></a>
                          </li>
                          <?php
                        } else {
                          ?>
                          <li>
                              <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">TITULAIRES</span></a>
                              <ul class="submenu-angle list-promotion" aria-expanded="false">
                                  <!--<li><a title="Add Professor" href="index.php?add_titulaire"><span class="mini-sub-pro">Ajouter</span></a></li>-->
                              </ul>
                          </li>
                          <li>
                              <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-student icon-wrap"></span> <span class="mini-click-non">ETUDIANTS</span></a>
                              <ul class="submenu-angle list-promotion" aria-expanded="false">
                                  <!--<li><a title="Add Students" href="index.php?add_student"><span class="mini-sub-pro">Ajouter</span></a></li>-->
                              </ul>
                          </li>
                          <li>
                              <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-course icon-wrap"></span> <span class="mini-click-non">COURS</span></a>
                              <ul class="submenu-angle list-promotion" aria-expanded="false">
                                  <!--<li><a title="Add Courses" href="index.php?add_cours"><span class="mini-sub-pro">Ajouter</span></a></li>-->
                              </ul>
                          </li>
                          <li>
                              <a href="index.php?gestion-jury" aria-expanded="false"><span class="educate-icon educate-department icon-wrap"></span> <span class="mini-click-non">JURY</span></a>
                          </li>
                          <?php
                        }                                       

                        ?>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="vue/gabarit/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                              <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                            <div class="header-top-menu tabl-d-n">
                                                <ul class="nav navbar-nav mai-top-nav">
                                                    <li class="nav-item"><a href="#" class="nav-link">N° MINESURS/CABMIN/043/2008</a>
                                                    </li>
                                                    <li class="nav-item"><a href="#" class="nav-link">DU 07/07/2008</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php
                                    if ($_SESSION['module'] == 'Titulaire') {
                                    ?>
                                      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                          <div class="header-right-info">
                                              <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                  <li class="nav-item">
                                                      <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                        <img src="vue/gabarit/img/logo/logo-ibtp.png" alt="" />
                                                        <span class="admin-name"><?= $_SESSION['grade'] ?>.<?= $_SESSION['nom'] ?> <?= $_SESSION['post_nom'] ?></span>
                                                        <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                      </a>
                                                      <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                          <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic chefSection">Statut : (<?= $_SESSION['statut'] ?>)</span></a>
                                                          </li>
                                                          <li><a href="#"><span class="edu-icon edu-money author-log-ic" id="effectifM-ista">Sexe (<?= $_SESSION['sexe'] ?>)</span></a>
                                                          </li>
                                                          <li><a href="#"><span class="edu-icon edu-settings author-log-ic" id="effectifF-ista">Tel. : <?= $_SESSION['telephone'] ?></span></a>
                                                          </li>
                                                          <li><a id="deconnexionBtn"><span class="edu-icon edu-locked author-log-ic">Déconnexion</span></a></li>
                                                      </ul>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div>
                                    <?
                                    }elseif ($_SESSION['module'] == 'Etudiant') {
                                    ?>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                      <img src="vue/gabarit/img/logo/logo-ibtp.png" alt="" />
                                                      <span class="admin-name"><?= $_SESSION['nom'] ?>.<?= $_SESSION['post_nom'] ?> <?= $_SESSION['prenom'] ?></span>
                                                      <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic">Code d'accèss (<?= $_SESSION['code_access'] ?>)</span></a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-money author-log-ic" >Sexe (<?= $_SESSION['sexe'] ?>)</span></a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic" >Tel. : <?= $_SESSION['telephone'] ?></span></a>
                                                        </li>
                                                        <li><a id="deconnexionBtn"><span class="edu-icon edu-locked author-log-ic">Déconnexion</span></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                    } elseif ($_SESSION['module'] == 'Operateur') {
                                    ?>
                                    
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                      <img src="vue/gabarit/img/logo/logo-ibtp.png" alt="" />
                                                      <span class="admin-name"><?= $_SESSION['nom'] ?> <?= $_SESSION['post_nom'] ?></span>
                                                      <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><?= $_SESSION['code_access'] ?></a>
                                                        </li>
                                                        <li><a href="#"><?= $_SESSION['sexe']?></a>
                                                        </li>
                                                        <li><a href="#"><?= $_SESSION['telephone'] ?></a>
                                                        </li>
                                                        <li><a href="index.php?deconnexion">Déconnexion</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                    } else {
                                    ?>
                                    
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                      <img src="vue/gabarit/img/logo/logo-ibtp.png" alt="" />
                                                      <span class="admin-name"><?= $_SESSION['grade'] ?>.<?= $_SESSION['nom'] ?> <?= $_SESSION['post_nom'] ?></span>
                                                      <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                    </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic chefSection"> (Chef)</span></a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-money author-log-ic" id="effectifM-ista"> (M)</span></a>
                                                        </li>
                                                        <li><a href="#"><span class="edu-icon edu-settings author-log-ic" id="effectifF-ista"> (F)</span></a>
                                                        </li>
                                                        <li><a href="index.php?deconnexion"><span class="edu-icon edu-locked author-log-ic"></span>Déconnexion</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Charts" href="index.php">Tableau de bord</a></li>
                                        <?php
                                        if ($_SESSION['module'] == 'Titulaire') {
                                        ?>
          
                                        <?php
                                        } else {
                                          ?>
                                          <li><a data-toggle="collapse" data-target="#demoevent" href="#">TITULAIRES <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                              <ul id="demoevent1" class="collapse dropdown-header-top list-promotion">
                                                  <li><a href="#">(DES ENSEIGNANTS)</a>
                                                  </li>
                                              </ul>
                                          </li>
                                          <li><a data-toggle="collapse" data-target="#demopro" href="#">ETUDIANTS <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                              <ul id="demopro" class="collapse dropdown-header-top list-promotion">
                                                  <li><a href="#">(DES ENSEIGNANTS)</a>
                                                  </li>
                                              </ul>
                                          </li>
                                          <li><a data-toggle="collapse" data-target="#democrou" href="#">COURS <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                              <ul id="democrou" class="collapse dropdown-header-top list-promotion">
                                                  <li><a href="#">(DES COURS)</a>
                                                  </li>
                                                  </li>
                                              </ul>
                                          </li>
                                          <?php
                                        }                                       

                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="breadcome-heading">
                                        <?php 
                                        if ($_SESSION['module'] == 'Section') {
                                        ?>
                                        <h2><?= $_SESSION['designation'] ?></h2>
                                        <?php
                                        } elseif ($_SESSION['module'] == 'Titulaire') {
                                        ?>
                                        <h2><?= $_SESSION['adresse'] ?> </h2>
                                        <?php
                                        }elseif ($_SESSION['module'] == 'Etudiant') {
                                        ?>
                                        <ul>
                                            <li><h3><span class="edu-icon edu-money author-log-ic" >Nationalite (<?= $_SESSION['nationalite'] ?>)</span></h3>
                                            </li>
                                            <li><h3><span class="edu-icon edu-money author-log-ic" >Lieu de naissance (<?= $_SESSION['lieu_naiss'] ?>)</span></h3>
                                            </li>
                                            <li><h3><span class="edu-icon edu-money author-log-ic" >Date de naissance (<?= $_SESSION['date_naiss'] ?>)</span></h3>
                                            </li>
                                        </ul>

                                        <?php
                                        } elseif ($_SESSION['module'] == "Coges") {
                                          ?>
                                          <h2><?= $_SESSION['grade'] ?></h2>
                                          <?php
                                        } elseif ($_SESSION['module'] == "Operateur") {
                                        ?>
                                        <h2><?= $_SESSION['grade'] ?></h2>
                                        <?php
                                        } else {
                                            print_r($_SESSION);
                                        }
                                        
                                        ?>    
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <ul class="breadcome-menu">
                                            <li><a href="#">IBTP-MATADI</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod"><?= strtoupper($_SESSION['module']) ?></span>
                                            </li>
                                            <?php
                                            if ($_SESSION['module'] == 'Section') {
                                              $data_promotion = getPromotionsList($_SESSION['id']);
                                              
                                              foreach ($data_promotion as $key => $value) {
                                                if (isset($_GET['promotion']) AND $_GET['promotion'] == $value['promo']) {
                                                  $label_promotion = $value['class'];
                                                } elseif (isset($_GET['etudiants']) AND $_GET['etudiants'] == $value['promo']) {
                                                  $label_promotion = $value['class'];
                                                } elseif (isset($_GET['enseignants']) AND $_GET['enseignants'] == $value['promo']) {
                                                  $label_promotion = $value['class'];
                                                  # code...
                                                } else {
                                                  # code...
                                                }
                                              }
                                              if(isset($label_promotion)){                                              
                                            ?>
                                            
                                            <li><span class="bread-slash">/</span><span class="bread-blod"><?= $label_promotion ?></span>
                                            </li>
                                            <?php
                                              }
                                              
                                            }  else {
                                              # code...
                                            }
                                            

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $contenu; ?>
        <br><br>
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a>/Application crée par ELMES (Contact : +243 85 310 24 26)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="vue/gabarit/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="vue/gabarit/js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="vue/gabarit/js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="vue/gabarit/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="vue/gabarit/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="vue/gabarit/js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="vue/gabarit/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="vue/gabarit/js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="vue/gabarit/js/counterup/jquery.counterup.min.js"></script>
    <script src="vue/gabarit/js/counterup/waypoints.min.js"></script>
    <script src="vue/gabarit/js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="vue/gabarit/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="vue/gabarit/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="vue/gabarit/js/metisMenu/metisMenu.min.js"></script>
    <script src="vue/gabarit/js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="vue/gabarit/js/morrisjs/raphael-min.js"></script>
    <script src="vue/gabarit/js/morrisjs/morris.js"></script>
    <!--<script src="vue/gabarit/js/morrisjs/morris-active.js"></script>-->
    <script src="js/morrisjs/custom-morris-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="vue/gabarit/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="vue/gabarit/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="vue/gabarit/js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="vue/gabarit/js/calendar/moment.min.js"></script>
    <script src="vue/gabarit/js/calendar/fullcalendar.min.js"></script>
    <script src="vue/gabarit/js/calendar/fullcalendar-active.js"></script>
    <script src="vue/gabarit/js/icheck/icheck.min.js"></script>
    <script src="vue/gabarit/js/icheck/icheck-active.js"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="vue/gabarit/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="vue/gabarit/js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
		============================================ -->
    <script src="vue/gabarit/js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
		============================================ -->
    <script src="vue/gabarit/js/chosen/chosen.jquery.js"></script>
    <script src="vue/gabarit/js/chosen/chosen-active.js"></script>
    <!-- select2 JS
		============================================ -->
    <script src="vue/gabarit/js/select2/select2.full.min.js"></script>
    <script src="vue/gabarit/js/select2/select2-active.js"></script>
    <!-- ionRangeSlider JS
		============================================ -->
    <script src="vue/gabarit/js/ionRangeSlider/ion.rangeSlider.min.js"></script>
    <script src="vue/gabarit/js/ionRangeSlider/ion.rangeSlider.active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="vue/gabarit/js/data-table/bootstrap-table.js"></script>
    <script src="vue/gabarit/js/data-table/tableExport.js"></script>
    <script src="vue/gabarit/js/data-table/data-table-active.js"></script>
    <script src="vue/gabarit/js/data-table/bootstrap-table-editable.js"></script>
    <script src="vue/gabarit/js/data-table/bootstrap-editable.js"></script>
    <script src="vue/gabarit/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="vue/gabarit/js/data-table/colResizable-1.5.source.js"></script>
    <script src="vue/gabarit/js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="vue/gabarit/js/editable/jquery.mockjax.js"></script>
    <script src="vue/gabarit/js/editable/mock-active.js"></script>
    <script src="vue/gabarit/js/editable/select2.js"></script>
    <script src="vue/gabarit/js/editable/moment.min.js"></script>
    <script src="vue/gabarit/js/editable/bootstrap-datetimepicker.js"></script>
    <script src="vue/gabarit/js/editable/bootstrap-editable.js"></script>
    <script src="vue/gabarit/js/editable/xediable-active.js"></script>
    <!-- notification JS
		============================================ -->
    <script src="vue/gabarit/js/notifications/Lobibox.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="vue/gabarit/js/chart/jquery.peity.min.js"></script>
    <script src="vue/gabarit/js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="vue/gabarit/js/tab.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="vue/gabarit/js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="vue/gabarit/js/main.js"></script>
    <!-- tawk chat JS
		============================================ -->
    <!--<script src="vue/gabarit/js/tawk-chat.js"></script>-->
    <?php 
    if ($_SESSION['module'] == 'Section') {
    ?>
    <script src="controleur/js/section.js"></script>
    <?php
    } elseif ($_SESSION['module'] == 'Coges') {
    ?>
    <script src="controleur/js/coges.js"></script>

    <?php
    } elseif ($_SESSION['module'] == 'Titulaire') {
      ?>
      <script src="controleur/js/titulaire.js"></script>
      <?php
    } elseif ($_SESSION['module'] == 'Etudiant') {
    ?>
    <!-- c3 JS
		============================================ -->
    <script src="vue/gabarit/js/c3-charts/d3.min.js"></script>
    <script src="vue/gabarit/js/c3-charts/c3.min.js"></script>
    <script src="controleur/js/etudiant.js"></script>

    <?php
    } else {
      ?>
      <script src="controleur/js/perception.js"></script>
      <?php
    }
    
    ?>
    <script>
      $('#deconnexionBtn').click(function (e) { 
        e.preventDefault();
        localStorage.setItem('moduleUser', "")
        window.location.replace('index.php?deconnexion')
      });
    </script>

</html>