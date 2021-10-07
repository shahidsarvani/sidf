<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    <div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            <span class="font-weight-semibold">Navigation</span>
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user-material">
                <div class="sidebar-user-material-body">
                    <div class="card-body text-center">
                        <a href="#">
                            <img src="<?php echo ADMIN_ASSET ?>/global_assets/images/placeholders/placeholder.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                        </a>
                        <h6 class="mb-0 text-white text-shadow-dark"><?php echo $_SESSION['user_username']; ?></h6>
                        <span class="font-size-sm text-white text-shadow-dark"><?php echo $_SESSION['user_email']; ?></span>
                    </div>

                    <div class="sidebar-user-material-footer">
                        <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
                    </div>
                </div>

                <div class="collapse" id="user-nav">
                    <ul class="nav nav-sidebar">
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-user-plus"></i>
                                <span>My profile</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?php echo ADMIN_SITE_URL.'/controller/logout.php' ?>" class="nav-link">
                                <i class="icon-switch2"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">

                    <!-- Main -->
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo ADMIN_SITE_URL.'/controller/dashboard.php' ?>" class="nav-link" id="navlink-dashboard">
                            <i class="icon-home4"></i>
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu" id="navlink-screens">
                        <a href="#" class="nav-link">
                            <i class="icon-display"></i> <span>Screens</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item">
                                <a href="<?php echo ADMIN_SITE_URL.'/controller/screens/index.php' ?>" class="nav-link" id="navlink-screens_index">All Screens</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ADMIN_SITE_URL.'/controller/screens/add.php' ?>" class="nav-link" id="navlink-screens_add">Add Screen</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu" id="navlink-timelineItems">
                        <a href="#" class="nav-link">
                            <i class="icon-calendar22"></i> <span>Timeline Items</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item">
                                <a href="<?php echo ADMIN_SITE_URL.'/controller/timelineItems/index.php' ?>" class="nav-link" id="navlink-timelineItems_index">All Timeline Items</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo ADMIN_SITE_URL.'/controller/timelineItems/add.php' ?>" class="nav-link" id="navlink-timelineItems_add">Add Timeline Item</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /main -->
                    <!-- /page kits -->

                </ul>
            </div>
            <!-- /main navigation -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">