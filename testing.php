<?php
session_start();
//if (!isset($_SESSION['user_id'])) {
//header('Location: ../../../frontend/auth/index.php');
// exit();
//}

include 'db/config.php';
include 'controllers/UsersController.php';
//include '../../../backend/controllers/tickets/ticketsController.php' ;
//include '../../../backend/controllers/dashboard/dashboardController.php' ;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/CITRMU_Logo.png" />
    <title> Ticketing System - CITRMU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

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
    <link rel="stylesheet" href="user_management.css">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- End layout styles -->
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
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
                    <a class="nav-link" href="dashboard.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="user_management.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Ticket management</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="pages/tables/basic-table.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Services</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="performance.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-bar"></i>
                        </span>
                        <span class="menu-title">Performance Tracker</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="testing.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-security"></i>
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
                    <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="img/CITRMU_Logo.png"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                    </ul>

                    <ul class="navbar-nav navbar-nav-left">
                        <li class="nav-item dropdown border-right">
                            <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-toggle="dropdown"
                                aria-expanded="false" href="#"> + Create New Ticket</a>
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
                        <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="img/profile-pic.jpg" alt="Profile Picture">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">Sheesh M. Rivero</p>
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


<div class="main-panel">
    <div class="row gutters">
        <div class="col-sm-12">
            <div class="card p-5">
                <?php

                // Check if the `alert` key is defined in the `$_GET` variable.
                if (isset($_GET['alert'])) {
                    // Get the value of the `alert` parameter.
                    $alertType = $_GET['alert'];

                    // Display an alert message based on the value of the `alert` parameter.
                    switch ($alertType) {
                        case 'new_member':
                            echo '<div class="bg-primary text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                            echo 'A new member has been added to the system.';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            break;
                        case 'member_deleted':
                            echo '<div class="bg-secondary text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                            echo 'A member has been deleted from the system.';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            break;
                        case 'member_restored':
                            echo '<div class="bg-info text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                            echo 'A member has been restored from the system.';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            break;
                        default:
                            echo '<div class="bg-secondary text-white alert alert-danger alert-dismissible fade show" role="alert">';
                            echo 'Unknown Alert Type.';
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            break;
                    }
                }

                ?>
                <div class="card-header d-flex justify-content-between">
                    <a data-bs-toggle="modal" data-bs-target="#addNewUserModal"
                        class="btn btn-primary d-flex gap-2 align-items-center"><span
                            class="icon-plus-outline"></span> + New User</a>
                    <a data-bs-toggle="modal" data-bs-target="#archivedUserModal"
                        class="btn btn-secondary d-flex gap-2 align-items-center"><span
                            class="material-symbols-outlined">
                            settings_backup_restore
                        </span></span>Archived Users</a>
                </div>
                <div class="card-body" style="height: 80vh; overflow-y: auto;">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">PROFILE PICTURE</th>
                                <th scope="col">ID</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">ROLE</th>
                                <th scope="col">DEPARTMENT</th>
                                <th scope="col">CREATED AT</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="p-5" style="color: black;">
                            <?php echo UsersControllerClass::getUsers(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class=" modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addNewUserModalLabel"> + Create new user</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="user/addUsers-script.php" method="post"
                                    enctype="multipart/form-data" class="p-3" style="width: 100%;">
                                    <div class="d-flex flex-wrap">
                                        <div class="col-md-12 d-flex flex-column gap-5">
                                            <div class="d-flex gap-2">
                                                <div class="form-group w-100 mx-auto">
                                                    <label for="profile_picture" class="py-2 text-muted">PROFILE
                                                        PICTURE:<span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control h-75 w-100 pt-4 ps-4"
                                                        id="profile_picture" name="profile_picture"
                                                        accept="image/jpeg, image/png, image/webp" required />
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <div class="form-group w-100">
                                                    <label for="department" class="py-2 text-muted">DEPARTMENT:<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control h-75 w-100"
                                                        id="department" placeholder="Department" name="department"
                                                        required>
                                                </div>
                                                <div class="form-group w-100">
                                                    <label for="role" class="py-2 text-muted">ROLE:<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control h-75 w-100"
                                                        aria-label="Default select example" name="role" id="role"
                                                        required>
                                                        <option value="TECHNICIAN" selected>TECHNICIAN</option>
                                                        <option value="MANAGER">MANAGER</option>
                                                        <option value="REQUESTOR">REQUESTOR</option>
                                                        <option value="ADMIN">ADMIN</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <div class="form-group w-100">
                                                    <label for="username" class="py-2 text-muted">INITIAL
                                                        USERNAME:<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control h-75 w-100" id="username"
                                                        placeholder="Username" name="username" required>
                                                </div>
                                                <div class="form-group w-100">
                                                    <label for="password" class="py-2 text-muted" >INITIAL
                                                        PASSWORD:<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control h-75 w-100" id="password"
                                                        placeholder="Password" name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-text text-secondary">The user is recommended to
                                                change
                                                the Initial
                                                Credentials after
                                                activating the account.</div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3 py-3 px-5 w-auto"
                                        name="add_account">CREATE
                                        ACCOUNT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END MODAL ADD NEW USER -->
                <!-- Modal -->
                <div class="modal fade" id="archivedUserModal" tabindex="-1"
                    aria-labelledby="archivedUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class=" modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="archivedUserModalLabel">Restore Deleted Users</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body" style="height: 80vh; overflow-y: auto;">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">PROFILE PICTURE</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">USERNAME</th>
                                                <th scope="col">ROLE</th>
                                                <th scope="col">DEPARTMENT</th>
                                                <th scope="col">CREATED AT</th>
                                                <th scope="col">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody class="p-5">
                                            <?php echo UsersControllerClass::getDeletedUsers(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL ARCHIVE-->
            </div>
        </div>
</div>
<footer class="footer">
        <div class="d-sm-flex justify-content-center ">
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a <a> City Information Technology and
                Records Management Unit</a>
        </footer>
        </div>
    </div>
    </html>
<!--/div>
</div-->

</div>




<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<!--
<-->

</body>

</htm>