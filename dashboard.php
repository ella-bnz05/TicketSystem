<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../TS/login/login.php');
  exit();
}
include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers/UsersController.php';
//include '../../../backend/controllers/tickets/ticketsController.php';
include 'C:\xampp\htdocs\TS\controllers/dashboardController.php';
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
    <?php
    include 'includes/_sidebar.php';
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php
      include 'includes/_navbar.php';
      ?>
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
                  <i class="fa-solid fa-user fa-2x"></i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal" style="font-size: 1.5rem;">Overall System <br> User Count</h6>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
              <h6 class="font-weight-bold mb-0"><?php echo DashboardControllerClass::getUsersCount(); ?></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <i class="fa-solid fa-users fa-2x">
                  </i>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal" style="font-size: 1.5rem;">Overall <br>CITRMU Personel</h6>
            <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0 font-weight-bold mb-0"">
              <h6 class=" font-weight-bold mb-0""><?php echo DashboardControllerClass::getTechnician(); ?>
              </h6>
            </div>
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
    <!-- Main Content Starts -->
    <!-- Main Content Starts -->
    <!-- Main Content Starts -->
    <div class="container-fluid">
      <div class="row">

        <!-- Top Section: Main Tickets Table -->
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between align-items-center">
                <h4 class="font-weight-bold card-title mb-1">TICKETS</h4>
                <a data-bs-toggle="modal" data-bs-target="#addNewUserModal" class="btn btn-secondary gap-2 align-items-center">
                  <span class="icon-plus-outline"></span>+
                </a>
              </div>
              <div class="d-flex justify-content-end mb-2">
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="preview-list">
                    <!-- Tickets Table -->
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                </label>
                              </div>
                            </th>
                            <th> Department </th>
                            <th> Ticket No </th>
                            <th> Assigned to</th>
                            <th> Service Request </th>
                            <th> Ticket Subject</th>
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
                              <span class="pl-2">HRMO</span>
                              <span class="pl-2">Aalihya Rivero</span>
                            </td>
                            <td> 02312 </td>
                            <td> Jihro </td>
                            <td> COMPUTER & NETWORK SUPPORT</td>
                            <td> Network issue </td>
                            <td> 04 Aug 2024 </td>
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
                              <span class="pl-2">HRMO</span>
                              <span class="pl-2">Estella Bryan</span>
                            </td>
                            <td> 02312 </td>
                            <td> Aicer </td>
                            <td> COMPUTER & NETWORK SUPPORT </td>
                            <td> Printer issue </td>
                            <td> 15 Aug 2024 </td>
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
                              <span class="pl-2">HRMO</span>
                              <span class="pl-2">Lucy Abbott</span>
                            </td>
                            <td> 02312 </td>
                            <td> Archie </td>
                            <td> COMPUTER & NETWORK SUPPORT</td>
                            <td> PC issue</td>
                            <td> 19 Aug 2024 </td>
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
                              <span class="pl-2">HRMO</span>
                              <span class="pl-2">Peter Gill</span>
                            </td>
                            <td> 02312 </td>
                            <td> Ella </td>
                            <td> COMPUTER & NETWORK SUPPORT </td>
                            <td> Network issue </td>
                            <td> 20 Aug 2024 </td>
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
                              <span class="pl-2">HRMO</span>
                              <span class="pl-2">Sallie Reyes</span>
                            </td>
                            <td> 02312 </td>
                            <td> Aalihya </td>
                            <td> COMPUTER & NETWORK SUPPORT </td>
                            <td> PC issue </td>
                            <td> 22 Dec 2024 </td>
                            <td>
                              <div class="btn btn-yellow">Pending</div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- End of Tickets Table -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Middle Section: Create Tickets and Evaluation Tables -->
        <div class="col-md-6 grid-margin stretch-card">
          <!-- Create Tickets Table -->
          <div class="card">
            <div class="card-body">
              <div class="d-flex d-md-block rounded mt-3">
                <h2 class="card-title">

                  <h4 class="font-weight-bold card-title mb-1">SERVICES</h4>
                  <p class="text-muted mb-1">Your data status</p>
                  <div class="col-12">
                    <div class="preview-list">
                      <!-- Preview Items -->
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
                            <p class="text-muted mb-0">30 tasks, 5 issues</p>
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
                            <p class="text-muted mb-0">23 tasks, 5 issues</p>
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
                            <p class="text-muted mb-0">27 tasks, 4 issues</p>
                          </div>
                        </div>
                      </div>
                      <!-- Repeat preview items as needed -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Middle Section: Evaluation Table -->
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="font-weight-bold card-title">Performance Tracker</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>Employee Name</th>
                      <th>Evaluator</th>
                      <th class="text-right">Average Percent</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Task 1</td>
                      <td>Ella Bañez</td>
                      <td>Jane Smith</td>
                      <td class="text-right">10%</td>
                    </tr>
                    <tr>
                      <td>Task 2</td>
                      <td>Archie Saragena</td>
                      <td>Mark Brown</td>
                      <td class="text-right">25%</td>
                    </tr>
                    <tr>
                      <td>Task 3</td>
                      <td>Ryan Robles</td>
                      <td>Cris Davis</td>
                      <td class="text-right">15%</td>
                    </tr>
                    <tr>
                      <td>Task 4</td>
                      <td>Aalihya Rivero</td>
                      <td>David Moore</td>
                      <td class="text-right">30%</td>
                    </tr>
                    <tr>
                      <td>Task 5</td>
                      <td>Aharah Jane Faustino</td>
                      <td>Laura Harris</td>
                      <td class="text-right">20%</td>
                    </tr>
                    <tr>
                      <td>Task 6</td>
                      <td>Rinoa Jayne Catanaoan</td>
                      <td>James Martinez</td>
                      <td class="text-right">35%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>


        <!-- Bottom Section: Tickets per Department -->
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="font-weight-bold card-title">Tickets per Department</h4>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><i class="flag-icon flag-icon-us"></i></td>
                      <td>HRMO</td>
                      <td class="text-right">1500</td>
                      <td class="text-right font-weight-medium">56.35%</td>
                    </tr>
                    <tr>
                      <td><i class="flag-icon flag-icon-de"></i></td>
                      <td>OBO</td>
                      <td class="text-right">800</td>
                      <td class="text-right font-weight-medium">33.25%</td>
                    </tr>
                    <tr>
                      <td><i class="flag-icon flag-icon-au"></i></td>
                      <td>CSWD</td>
                      <td class="text-right">760</td>
                      <td class="text-right font-weight-medium">15.45%</td>
                    </tr>
                    <tr>
                      <td><i class="flag-icon flag-icon-gb"></i></td>
                      <td>CSO</td>
                      <td class="text-right">450</td>
                      <td class="text-right font-weight-medium">25.00%</td>
                    </tr>
                    <tr>
                      <td><i class="flag-icon flag-icon-ro"></i></td>
                      <td>GSO</td>
                      <td class="text-right">620</td>
                      <td class="text-right font-weight-medium">10.25%</td>
                    </tr>
                    <tr>
                      <td><i class="flag-icon flag-icon-br"></i></td>
                      <td>ADMIN</td>
                      <td class="text-right">230</td>
                      <td class="text-right font-weight-medium">75.00%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Main Content Ends -->
  </div>
</div>

<!-- Footer Starts -->
<!-- Footer Ends -->

<!-- Page Body Wrapper Ends -->
</div>
</div>
<?php include 'includes/_footer.php'; ?>

<!-- Container Scroller Ends -->

<!-- Plugins JS -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- Plugin JS for this Page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End Plugin JS for this Page -->

<!-- Inject JS -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/todolist.js"></script>
<!-- End Inject JS -->

<!-- Custom JS for this Page -->
<script src="assets/js/dashboard.js"></script>
<!-- End Custom JS for this Page -->

</body>

</html>