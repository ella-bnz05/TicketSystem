<?php
session_start();
//if (!isset($_SESSION['user_id'])) {
	//header('Location: ../../../frontend/auth/index.php');
//	exit();
//}

include 'db/config.php';
include 'controllers/UsersController.php';
//include '../../../backend/controllers/tickets/ticketsController.php';
//include '../../../backend/controllers/dashboard/dashboardController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="img/CITRMU_Logo.png" />
  <title> Ticketing System - CITRMU</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/6.7.96/css/materialdesignicons.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- End layout styles -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <a class="nav-link dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html">
            <h1 class="fs-8" style=" font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"> CITRMU</h1>
          </a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Aalihya M. Rivero</h5>
                  <span>Kpop Member</span>
                </div>
              </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="#">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Ticket management</span>
              <i class="menu-arrow"></i>
            </a>

            <span class="menu-icon">
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Reporting and analytics</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Integrations</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">People</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="pages/icons/mdi.html">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
              <span class="menu-title">Archive</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-security"></i>
              </span>
              <span class="menu-title">Inventory</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="user_management.php">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Users Management</span>
            </a>
          </li>
        </ul>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
              alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-lg-block">
              <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown"
                aria-expanded="false" href="#">+ Create New Ticket</a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="createbuttonDropdown">
                <h6 class="p-3 mb-0">Projects</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-file-outline text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Software Development</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-web text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">UI Development</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-layers text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Software Testing</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">See all projects</p>
              </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-view-grid"></i>
              </a>
            </li>
            <li class="nav-item dropdown border-left">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown"
                aria-expanded="false">
                <i class="mdi mdi-email"></i>
                <span class="count bg-success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                    <p class="text-muted mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                    <p class="text-muted mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                    <p class="text-muted mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">4 new messages</p>
              </div>
            </li>
            <li class="nav-item dropdown border-left">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                data-toggle="dropdown">
                <i class="mdi mdi-bell"></i>
                <span class="count bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Event today</p>
                    <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                    <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-link-variant text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Launch Admin</p>
                    <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">See all notifications</p>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="img/profile-pic.jpg" alt="Profile Picture">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">Aalihya M. Rivero</p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="#">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="#">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">Advanced settings</p>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <!-- Optional: Include custom scripts -->
      <script>
        // Add custom JavaScript here if needed
      </script>
</body>

</html>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <i class="fa-solid fa-user"></i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Overall System </h6>
            <p>User Count</p>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <i class="fa-solid fa-users">
                  </i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Overall </h6>
            <p> CITRMU Personel</p>
          </div>
        </div>
      </div>
     <!--<div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Services</h6>
            <p> Offered</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <i class="fa-solid fa-ticket"></i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Overall </h6>
            <p> Tickets Completed</p>

          </div>
        </div>
      </div>--> 
    </div>
    <div class="row">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Monthly Tickets</h4>
            <!-- <canvas id="transaction-history" class="transaction-chart"></canvas> -->
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Total Services</h6>
                <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">000</h6>
              </div>
            </div>
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Total of tickets</h6>
                <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">000</h6>
              </div>
            </div>
            <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
              <div class="text-md-center text-xl-left">
                <h6 class="mb-1">Total Services</h6>
                <p class="text-muted mb-0">07 Jan 2019, 09:12AM</p>
              </div>
              <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                <h6 class="font-weight-bold mb-0">000</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--RATINGS-->
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title mb-1">RATINGS</h4>
              <p class="text-muted mb-1">Your data status</p>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="preview-list">
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-primary">
                        <i class="mdi mdi-file-document"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Admin dashboard design</h6>
                        <p class="text-muted mb-0">Broadcast web app mockup</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">15 minutes ago</p>
                        <p class="text-muted mb-0">30 tasks, 5 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-cloud-download"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Wordpress Development</h6>
                        <p class="text-muted mb-0">Upload new design</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">1 hour ago</p>
                        <p class="text-muted mb-0">23 tasks, 5 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-clock"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Project meeting</h6>
                        <p class="text-muted mb-0">New project discussion</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">35 minutes ago</p>
                        <p class="text-muted mb-0">15 tasks, 2 issues</p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-danger">
                        <i class="mdi mdi-email-open"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Broadcast Mail</h6>
                        <p class="text-muted mb-0">Sent release details to team</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">55 minutes ago</p>
                        <p class="text-muted mb-0">35 tasks, 7 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-chart-pie"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">UI Design</h6>
                        <p class="text-muted mb-0">New application planning</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">50 minutes ago</p>
                        <p class="text-muted mb-0">27 tasks, 4 issues </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--DITO ARCHIE TABLE-->
    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">TICKETS</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </th>
                    <th> Department </th>
                    <th> Ticket No </th>
                    <th> Product Cost </th>
                    <th> Project </th>
                    <th> Service </th>
                    <th> Start Date </th>
                    <th> Status </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </td>
                    <td>
                      <img src="me.png" alt="image" />
                      <span class="pl-2">Aalihya Rivero</span>
                    </td>
                    <td> 02312 </td>
                    <td> $14,500 </td>
                    <td> Dashboard </td>
                    <td> Credit card </td>
                    <td> 04 Dec 2019 </td>
                    <td>
                      <div class="btn btn-green">Approved</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </td>
                    <td>
                      <img src="assets/images/faces/face2.jpg" alt="image" />
                      <span class="pl-2">Estella Bryan</span>
                    </td>
                    <td> 02312 </td>
                    <td> $14,500 </td>
                    <td> Website </td>
                    <td> Cash on delivered </td>
                    <td> 04 Dec 2019 </td>
                    <td>
                      <div class="btn btn-yellow">Pending</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </td>
                    <td>
                      <img src="assets/images/faces/face5.jpg" alt="image" />
                      <span class="pl-2">Lucy Abbott</span>
                    </td>
                    <td> 02312 </td>
                    <td> $14,500 </td>
                    <td> App design </td>
                    <td> Credit card </td>
                    <td> 04 Dec 2019 </td>
                    <td>
                      <div class="btn btn-red">Eme</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </td>
                    <td>
                      <img src="assets/images/faces/face3.jpg" alt="image" />
                      <span class="pl-2">Peter Gill</span>
                    </td>
                    <td> 02312 </td>
                    <td> $14,500 </td>
                    <td> Development </td>
                    <td> Online Payment </td>
                    <td> 04 Dec 2019 </td>
                    <td>
                      <div class="btn btn-green">Approved</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-check form-check-muted m-0">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                        </label>
                      </div>
                    </td>
                    <td>
                      <img src="assets/images/faces/face4.jpg" alt="image" />
                      <span class="pl-2">Sallie Reyes</span>
                    </td>
                    <td> 02312 </td>
                    <td> $14,500 </td>
                    <td> Website </td>
                    <td> Credit card </td>
                    <td> 04 Dec 2019 </td>
                    <td>
                      <div class="btn btn-yellow">Pending</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--SERVICES-->
    <div class="row ">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
              <h4 class="card-title mb-1">SERVICES</h4>
              <p class="text-muted mb-1">Your data status</p>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="preview-list">
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-primary">
                        <i class="mdi mdi-file-document"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Admin dashboard design</h6>
                        <p class="text-muted mb-0">Broadcast web app mockup</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">15 minutes ago</p>
                        <p class="text-muted mb-0">30 tasks, 5 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-cloud-download"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Wordpress Development</h6>
                        <p class="text-muted mb-0">Upload new design</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">1 hour ago</p>
                        <p class="text-muted mb-0">23 tasks, 5 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-clock"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Project meeting</h6>
                        <p class="text-muted mb-0">New project discussion</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">35 minutes ago</p>
                        <p class="text-muted mb-0">15 tasks, 2 issues</p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item border-bottom">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-danger">
                        <i class="mdi mdi-email-open"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">Broadcast Mail</h6>
                        <p class="text-muted mb-0">Sent release details to team</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">55 minutes ago</p>
                        <p class="text-muted mb-0">35 tasks, 7 issues </p>
                      </div>
                    </div>
                  </div>
                  <div class="preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-chart-pie"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-sm-flex flex-grow">
                      <div class="flex-grow">
                        <h6 class="preview-subject">UI Design</h6>
                        <p class="text-muted mb-0">New application planning</p>
                      </div>
                      <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                        <p class="text-muted">50 minutes ago</p>
                        <p class="text-muted mb-0">27 tasks, 4 issues </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--VISITOR BY DEPARTMENT-->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Tickets per Department</h4>
            <div class="row">
              <div class="col-md-5">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-us"></i>
                        </td>
                        <td>USA</td>
                        <td class="text-right"> 1500 </td>
                        <td class="text-right font-weight-medium"> 56.35% </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-de"></i>
                        </td>
                        <td>Germany</td>
                        <td class="text-right"> 800 </td>
                        <td class="text-right font-weight-medium"> 33.25% </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-au"></i>
                        </td>
                        <td>Australia</td>
                        <td class="text-right"> 760 </td>
                        <td class="text-right font-weight-medium"> 15.45% </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-gb"></i>
                        </td>
                        <td>United Kingdom</td>
                        <td class="text-right"> 450 </td>
                        <td class="text-right font-weight-medium"> 25.00% </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-ro"></i>
                        </td>
                        <td>Romania</td>
                        <td class="text-right"> 620 </td>
                        <td class="text-right font-weight-medium"> 10.25% </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="flag-icon flag-icon-br"></i>
                        </td>
                        <td>Brasil</td>
                        <td class="text-right"> 230 </td>
                        <td class="text-right font-weight-medium"> 75.00% </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--INSERT GRAPH HERE-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center ">
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a <a> City Information Technology and
          Records Management Unit</a>
    </div>
  </footer>
  <!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>

</html>