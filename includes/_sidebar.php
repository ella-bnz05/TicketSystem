<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <!--<a class="nav-link dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true"
      aria-expanded="false"> -->
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="dashboard.php">
        <h1 class="fs-8" style=" font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> CITRMU</h1>
      </a>
      <a class="sidebar-brand brand-logo-mini" href="dashboard.php"><img src="img/CITRMU_Logo.png"
          alt="logo" />
    </div>
    <ul class="nav">
      <li class="nav-item profile">
        <div class="profile-desc">
          <div class="profile-pic">
            <div class="count-indicator">
            <div class="navbar-profile">
            <img class="img-xs rounded-circle" src="../../TS/backend/user-images/<?php echo $_SESSION['unique_id']; ?>/<?php echo $_SESSION['img_user_profile_picture']; ?>"
              alt="pic" />
          </div>
        </a>              
            </div>
            <div class="profile-name">
              <h3 class="mb-0 font-weight-bold"><span><?php echo $_SESSION['user_username']; ?></h3>
              <span><?php echo $_SESSION['user_role']; ?></span></span>
            </div>
          </div>
      </li>
      <li class="nav-item nav-category">
        <span class="nav-link">Navigation</span>
      </li>
      <li class="nav-item menu-items">
        <a class="nav-link" href="dashboard.php"  <?php echo (strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false) ? 'class="current-page"' : ''; ?>>
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER' || $_SESSION['user_role'] === 'REQUESTOR') { ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="ticket.php"<?php echo (strpos($_SERVER['REQUEST_URI'], 'tickets') !== false) ? 'class="current-page"' : ''; ?> >
          <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
          </span>
          <span class="menu-title">Ticket management</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($_SESSION['user_role'] === 'ADMIN') { ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="services.php">
          <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
          </span>
          <span class="menu-title">Services</span>
        </a>
      </li>
      <?php } ?>
      <?php if ($_SESSION['user_role'] === 'ADMIN') { ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="testing.php">
          <span class="menu-icon">
            <i class="mdi mdi-chart-bar"></i>
          </span>
          <span class="menu-title">Performance Tracker</span>
        </a>
      </li>
      <?php } ?>
      </li>
      <?php if ($_SESSION['user_role'] === 'ADMIN') { ?>
      <li class="nav-item menu-items">
        <a class="nav-link" href="user_management.php" <?php echo (strpos($_SERVER['REQUEST_URI'], 'user_management') !== false) ? 'class="current-page"' : ''; ?>>
          <span class="menu-icon">
            <i class="mdi mdi-security"></i>
          </span>
          <span class="menu-title">Users Management</span>
        </a>
      </li>
      <?php } ?>
    </ul>
  </nav>
