<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FlexStart Bootstrap Template - Index</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url() ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url() ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: FlexStart - v1.12.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?= base_url()?>" class="logo d-flex align-items-center">
        <span>SIPH</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto <?= ($page == 'home') ? 'active' : '' ?>" href="<?= base_url()?>">Home</a></li>

          <?php if ($this->session->userdata('logged_in')){ ?>
            <li><a class="nav-link scrollto <?= ($page == 'monitoring') ? 'active' : '' ?>" href="<?= base_url()?>index.php/monitoring">Monitoring</a></li>
          <?php } ?>

          <li><a class="nav-link scrollto <?= ($page == 'contact') ? 'active' : '' ?>" href="<?= base_url() ?>index.php/contact">Contact</a></li>
          
          <?php if ($this->session->userdata('logged_in')){ ?>
            <li class="dropdown"><a href="#"><span><?= $this->session->userdata('username') ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="<?= base_url()?>index.php/auth/logout" class="text-danger">Logout</a></li>
              </ul>
            </li>
          <?php } else { ?>
            <li class="dropdown"><a href="#"><span>Login Here</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Login</a></li>
              </ul>
            </li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->