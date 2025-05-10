<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="<?php echo base_url() ?>assets/" data-template="vertical-menu-template">


<!-- Mirrored from demos.pixinvent.com/frest-html-admin-template/html/vertical-menu-template/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:17:25 GMT -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Login | Savvy Agent</title>


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
  <!-- Vendor -->
  <link rel="stylesheet"
    href="<?php echo base_url() ?>assets/vendor/libs/%40form-validation/umd/styles/index.min.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/css/pages/page-auth.css">

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

  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">

        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img 
        src="<?= base_url('assets/sa_logo.png') ?>" 
        alt="SA Logo" 
        style="width:26px; height:26px;"
      />

                </span>
                <span class="app-brand-text demo h3 mb-0 fw-bold">Savvy Agent</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to Savvy Agents! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="formAuthentication" class="mb-3" action="<?php echo base_url() . "login" ?>" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email or Username</label>
                <input type="text" class="form-control" id="email" name="email"
                  placeholder="Enter your email or username" autofocus>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <!-- <a href="auth-forgot-password-basic.html">
                  <small>Forgot Password?</small>
                </a> -->
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <!-- <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
            </div> -->
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>

            <!-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-basic.html">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-4">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
              <i class="tf-icons bx bxl-facebook"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
              <i class="tf-icons bx bxl-google-plus"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
              <i class="tf-icons bx bxl-twitter"></i>
            </a>
          </div> -->
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->



  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="<?php echo base_url() ?>assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/libs/popper/popper.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/js/bootstrap.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/libs/hammer/hammer.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/libs/i18n/i18n.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/js/menu.js"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?php echo base_url() ?>assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
  <script
    src="<?php echo base_url() ?>assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script
    src="<?php echo base_url() ?>assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>

  <!-- Main JS -->
  <script src="<?php echo base_url() ?>assets/js/main.js"></script>


  <!-- Page JS -->
  <script src="<?php echo base_url() ?>assets/js/pages-auth.js"></script>

</body>


</html>

<!-- beautify ignore:end -->