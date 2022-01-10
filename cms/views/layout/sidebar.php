<div class="page-content">
  <div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    <div class="sidebar-mobile-toggler text-center"> <a href="#" class="sidebar-mobile-main-toggle"> <i class="icon-arrow-left8"></i> </a> <span class="font-weight-semibold">Navigation</span> <a href="#" class="sidebar-mobile-expand"> <i class="icon-screen-full"></i> <i class="icon-screen-normal"></i> </a> </div>
    <div class="sidebar-content">
      <div class="sidebar-user-material">
        <div class="sidebar-user-material-body">
          <div class="card-body text-center"> <a href="#"> <img src="<?php echo ADMIN_ASSET ?>/global_assets/images/placeholders/placeholder.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt=""> </a>
            <h6 class="mb-0 text-white text-shadow-dark"><?php echo $_SESSION['user_username']; ?></h6>
            <span class="font-size-sm text-white text-shadow-dark"><?php echo $_SESSION['user_email']; ?></span>
          </div>
          <div class="sidebar-user-material-footer"> <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a> </div>
        </div>
        <div class="collapse" id="user-nav">
          <ul class="nav nav-sidebar">
            <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/logout.php' ?>" class="nav-link"> <i class="icon-switch2"></i> <span>Logout</span> </a> </li>
          </ul>
        </div>
      </div>
      <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">
          <li class="nav-item">
            <a href="<?php echo ADMIN_SITE_URL . '/controller/dashboard.php' ?>" class="nav-link" id="navlink-dashboard"> <i class="icon-home4"></i> <span> Dashboard </span> </a>
          </li>
          <!-- SIDF Timeline -->
          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">SIDF Timeline</div>
            <i class="icon-menu" title="SIDF Timeline"></i>
          </li>
          <li class="nav-item nav-item-submenu" id="navlink-screens"> <a href="#" class="nav-link"> <i class="icon-display"></i> <span>Screens</span> </a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/screens/index.php' ?>" class="nav-link" id="navlink-screens_index">All Screens</a> </li>
            </ul>
          </li>
          <li class="nav-item nav-item-submenu" id="navlink-timelineItems"> <a href="#" class="nav-link"> <i class="icon-calendar22"></i> <span>Timeline Items</span> </a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/timelineItems/index.php' ?>" class="nav-link" id="navlink-timelineItems_index">All Timeline Items</a> </li>
            </ul>
          </li>
          <li class="nav-item nav-item-submenu" id="navlink-modals"> <a href="#" class="nav-link"> <i class="icon-gallery"></i> <span>Modals</span> </a>
            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/modals/index.php' ?>" class="nav-link" id="navlink-modals_index">All Modals</a> </li>
            </ul>
          </li>
          <!-- Process Interactive Screens -->
          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Process Interactive Screens</div>
            <i class="icon-menu" title="Process Interactive Screens"></i>
          </li>
          <li class="nav-item nav-item-submenu" id="navlink-sections"> <a href="#" class="nav-link"> <i class="icon-grid"></i> <span> Sections </span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Sections">
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/sections/index.php' ?>" class="nav-link" id="navlink-sectionItems_index">All Sections</a> </li>
            </ul>
          </li>
          <!-- RFID -->
          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">RFID</div>
            <i class="icon-menu" title="RFID"></i>
          </li>
          <li class="nav-item nav-item-submenu" id="navlink-tokens"> <a href="#" class="nav-link"> <i class="icon-grid6"></i> <span> Tokens </span></a>
            <ul class="nav nav-group-sub" data-submenu-title="Tokens">
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/tokens/index.php' ?>" class="nav-link" id="navlink-tokens_index">All Tokens</a> </li>
              <li class="nav-item"> <a href="<?php echo ADMIN_SITE_URL . '/controller/companies/index.php' ?>" class="nav-link" id="navlink-companies_index">Company Information</a> </li>
            </ul>
          </li>
          <!-- Final Zone -->
          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Final Zone</div>
            <i class="icon-menu" title="RFID"></i>
          </li>
          <li class="nav-item">
            <a href="<?php echo ADMIN_SITE_URL . '/controller/finalzone/index.php' ?>" class="nav-link" id="navlink-finalzone"> <i class="icon-screen3"></i> <span> Final Zone Screens </span> </a>
          </li>
          <!-- Projector Video -->
          <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Projector Video</div>
            <i class="icon-menu" title="RFID"></i>
          </li>
          <li class="nav-item">
            <a href="<?php echo ADMIN_SITE_URL . '/controller/projector/index.php' ?>" class="nav-link" id="navlink-projector"> <i class="icon-video-camera"></i> <span> Projector Video </span> </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="content-wrapper">