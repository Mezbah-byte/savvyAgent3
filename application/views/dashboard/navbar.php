<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


  <div class="app-brand demo ">
  <a href="<?php echo base_url('dashboard') ?>" class="app-brand-link">
    <span class="app-brand-logo demo">
      <img 
        src="<?= base_url('assets/sa_logo.png') ?>" 
        alt="Frest Logo" 
        style="width:26px; height:26px;"
      />
    </span>
    <span class="app-brand-text demo menu-text fw-bold ms-2">Savvy <br> Agent</span>
  </a>


    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
      <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
    </a>
  </div>


  <div class="menu-divider mt-0  ">
  </div>

  <div class="menu-inner-shadow"></div>



  <ul class="menu-inner py-1">
    <li class="menu-item">
      <a href="<?php echo base_url('dashboard') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>


    <!-- <li class="menu-item">
      <a href="<?php echo base_url('products') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Products">Products</div>
      </a>
    </li> -->


    <li class="menu-item">
      <a href="<?php echo base_url('courses') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Courses">Courses</div>
      </a>
    </li>


    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Orders">Orders</div>
      </a>

      <ul class="menu-sub">

        <li class="menu-item">
          <a href="<?php echo base_url('orderList/0') ?>" class="menu-link">
            <div data-i18n="Payment Pending Orders">Payment Pending Orders</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo base_url('orderList/1') ?>" class="menu-link">
            <div data-i18n="Payment Successfull Orders">Payment Successfull Orders</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo base_url('orderList/2') ?>" class="menu-link">
            <div data-i18n="Payment Canceled Orders">Payment Canceled Orders</div>
          </a>
        </li>

      </ul>
    </li>


    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="My Payment Gateways">My Payment Gateways</div>
      </a>

      <ul class="menu-sub">

        <li class="menu-item">
          <a href="<?php echo base_url('myGateways/1') ?>" class="menu-link">
            <div data-i18n="Active Gateways">Active Gateways</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?php echo base_url('myGateways/0') ?>" class="menu-link">
            <div data-i18n="Inactive Gateways">Inactive Gateways</div>
          </a>
        </li>

      </ul>
    </li>



    <!-- Layouts -->
    <!-- <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Layouts</div>
      </a>

      <ul class="menu-sub">

        <li class="menu-item">
          <a href="layouts-collapsed-menu.html" class="menu-link">
            <div data-i18n="Collapsed menu">Collapsed menu</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-content-navbar.html" class="menu-link">
            <div data-i18n="Content navbar">Content navbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-content-navbar-with-sidebar.html" class="menu-link">
            <div data-i18n="Content nav + Sidebar">Content nav + Sidebar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="https://demos.pixinvent.com/frest-html-admin-template/html/horizontal-menu-template" class="menu-link" target="_blank">
            <div data-i18n="Horizontal">Horizontal</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-without-menu.html" class="menu-link">
            <div data-i18n="Without menu">Without menu</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-without-navbar.html" class="menu-link">
            <div data-i18n="Without navbar">Without navbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-fluid.html" class="menu-link">
            <div data-i18n="Fluid">Fluid</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-container.html" class="menu-link">
            <div data-i18n="Container">Container</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-blank.html" class="menu-link">
            <div data-i18n="Blank">Blank</div>
          </a>
        </li>
      </ul>
    </li> -->




    <!-- Components -->
    <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Components">Components</span></li> -->
    <!-- Cards -->

  </ul>



</aside>
<!-- / Menu -->