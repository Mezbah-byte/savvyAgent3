<!DOCTYPE html>




<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
  data-theme="theme-default" data-assets-path="<?php echo base_url() ?>assets/" data-template="vertical-menu-template">


<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/app-logistics-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:12:50 GMT -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Savvy Agent</title>


  <meta name="description" content="Savvy Agent – your all-in-one dashboard for managing agents, courses, and requests effortlessly." />
  <meta name="keywords" content="savvy agent, agent dashboard, course requests, agent management" />

  <!-- Canonical SEO -->
  <link rel="canonical" href="https://1.envato.market/frest_admin">


  <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');</script>
  <!-- End Google Tag Manager -->

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon"
    href="<?= base_url('assets/sa_logo.png')?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fonts/fontawesome.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fonts/flag-icons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/rtl/core.css"
    class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/rtl/theme-default.css"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/typeahead-js/typeahead.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
  <link rel="stylesheet"
    href="<?php echo base_url() ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

  <!-- Page CSS -->

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/pages/app-logistics-dashboard.css" />

  <!-- Helpers -->
  <script src="<?php echo base_url() ?>assets/vendor/js/helpers.js"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="<?php echo base_url() ?>assets/vendor/js/template-customizer.js"></script>
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?php echo base_url() ?>assets/js/config.js"></script>

</head>

<body>


  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
      style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">




      <?php include('navbar.php') ?>