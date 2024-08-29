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
    <link rel="stylesheet" href="evaluation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- End layout styles -->
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <?php include 'includes/_sidebar.php'; ?>
        
        <!-- Page Body Wrapper -->
        <div class="container-fluid page-body-wrapper">
            <!-- Navbar -->
            <?php include 'includes/_navbar.php'; ?>
            
            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <div class="col-lg-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-tools">
                                </div>
                                <div class="search-container">
                                    <input type="text" class="form-control search-input" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="list">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Task</th>
                                        <th>Name</th>
                                        <th>Evaluator</th>
                                        <th width="15%">Performance Average</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center">1</th>
                                        <td><b>Task Example</b></td>
                                        <td><b>John Doe</b></td>
                                        <td><b>Jane Smith</b></td>
                                        <td><b>85.00%</b></td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item view_evaluation" href="view_evaluation.php" data-toggle="modal" data-target="#viewEvaluationModal">View</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_evaluation" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Additional rows would go here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="viewEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="viewEvaluationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewEvaluationModalLabel">Evaluation Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Task</b></dt>
                                            <dd>Task Example</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Assign To</b></dt>
                                            <dd>John Doe</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Evaluator</b></dt>
                                            <dd>Jane Smith</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Date Evaluated</b></dt>
                                            <dd>01/01/2024</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Remarks</b></dt>
                                            <dd>Some remarks here.</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Ratings:</b>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Efficiency</b></dt>
                                            <dd>90%</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Timeliness</b></dt>
                                            <dd>80%</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Quality</b></dt>
                                            <dd>85%</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Accuracy</b></dt>
                                            <dd>87%</dd>
                                        </dl>
                                        <dl>
                                            <dt><b class="border-bottom border-primary">Performance Average</b></dt>
                                            <dd>85.00%</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    
    <!-- Footer -->
    <?php include 'includes/_footer.php'; ?>
</body>

</html>
shee