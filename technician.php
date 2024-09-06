<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../TS/login/login.php');
    exit();
}

include 'backend/db/config.php';
include 'controllers/UsersController.php';
include 'controllers/ticketsController.php';
include 'controllers/technicianController.php';
include 'controllers/dashboardController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row gutters">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <a data-bs-toggle="modal" data-bs-target="#addNewUserModal"
                            class="btn btn-primary d-flex gap-2 align-items-center"><span
                                class="icon-plus-outline"></span>Create a Ticket</a>

                        <a data-bs-toggle="modal" data-bs-target="#archivedUserModal"
                            class="btn btn-secondary d-flex gap-2 align-items-center"><span
                                class="material-symbols-outlined">
                                settings_backup_restore
                            </span></span>Completed Tickets</a>
                    </div>

            
                    <?php

                    // Check if the `alert` key is defined in the `$_GET` variable.
                    if (isset($_GET['alert'])) {
                        // Get the value of the `alert` parameter.
                        $alertType = $_GET['alert'];

                        // Display an alert message based on the value of the `alert` parameter.
                        switch ($alertType) {
                            case 'new_technician':
                                echo '<div class="bg-primary text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                                echo 'A new technician has been added.';
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                break;
                            case 'techinician_deleted':
                                echo '<div class="bg-secondary text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                                echo 'A technician has been deleted.';
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                break;
                            case 'techinician_restored':
                                echo '<div class="bg-info text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                                echo 'A technician has been restored.';
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
                    <div class="card-body" style="height: 80vh; overflow-y: auto;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Technian ID</th>
                                    <th scope="col">Requested By</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Service Request</th>
                                    <th scope="col">Ticket Subject</th>
                                    <th scope="col">Ticket Description</th>
                                    <th scope="col">Ticket Issued On</th>
                                    <!--th scope="col">Actions</th-->
                                </tr>
                            </thead>
                            <tbody class="py-5">
                            <?php echo TicketsControllerClass::getTicketsDashboardIndex(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Ticket -->
        <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class=" modal-content">
                    <div class="modal-body">
                        <form action="../../TS/backend/scripts/tickets/addTickets-script.php" method="post"
                            enctype="multipart/form-data" class="p-3" style="width: 100%;">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-12 d-flex flex-column gap-5">
                                    <div class="d-flex gap-2">
                                        <span class="fs-5 text-muted">
                                            Requestor's Details
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="creator_username"
                                                class="py-2 text-muted">CREATOR
                                                USERNAME:<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="creator_username"
                                                placeholder="<?php echo $_SESSION['user_username']; ?>"
                                                name="creator_username"
                                                value="<?php echo $_SESSION['user_username']; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="creator_unique_id"
                                                class="py-2 text-muted">CREATOR
                                                ID:<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="creator_unique_id"
                                                placeholder="<?php echo $_SESSION['unique_id']; ?>"
                                                name="creator_unique_id"
                                                value="<?php echo $_SESSION['unique_id']; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="creator_department" class="py-2 text-muted">OFFICE
                                                /
                                                DEPARTMENT (CREATOR):<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="creator_department"
                                                placeholder="<?php echo $_SESSION['user_department']; ?>"
                                                name="creator_department"
                                                value="<?php echo $_SESSION['user_department']; ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="requestor_username"
                                                    class="py-2 text-muted">REQUESTOR
                                                    USERNAME:<span class="text-danger">*</span></label>
                                                <select class="form-control h-75 w-100" name="requestor_username"
                                                    id="requestor_username" required>
                                                    <option value=" " selected></option>
                                                    <option
                                                        value="<?php echo UsersControllerClass::getRequestor(); ?>">
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="requestor_unique_id"
                                                    class="py-2 text-muted">REQUESTOR
                                                    ID:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="requestor_unique_id"
                                                    placeholder=" "
                                                    name="requestor_unique_id"
                                                    value=" " readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="requestor_department" class="py-2 text-muted">OFFICE
                                                    /
                                                    DEPARTMENT (REQUESTOR):<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="requestor_department"
                                                    placeholder=" "
                                                    name="requestor_department"
                                                    value=" "
                                                    readonly>
                                            </div>
                                        </div>

                                    <?php } elseif ($_SESSION['user_role'] === 'REQUESTOR') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="requestor_username"
                                                    class="py-2 text-muted">REQUESTOR
                                                    USERNAME:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="requestor_username"
                                                    placeholder="<?php echo $_SESSION['user_username']; ?>"
                                                    name="requestor_username"
                                                    value="<?php echo $_SESSION['user_username']; ?>" readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="requestor_unique_id"
                                                    class="py-2 text-muted">REQUESTOR
                                                    ID:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="requestor_unique_id"
                                                    placeholder="<?php echo $_SESSION['unique_id']; ?>"
                                                    name="requestor_unique_id"
                                                    value="<?php echo $_SESSION['unique_id']; ?>" readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="requestor_department" class="py-2 text-muted">OFFICE
                                                    /
                                                    DEPARTMENT (REQUESTOR):<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="requestor_department"
                                                    placeholder="<?php echo $_SESSION['user_department']; ?>"
                                                    name="requestor_department"
                                                    value="<?php echo $_SESSION['user_department']; ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="is_assigned_to"
                                                    class="py-2 text-muted">TECHNICIAN:<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control h-75 w-100" name="is_assigned_to"
                                                    id="is_assigned_to" required>
                                                    <option value=" " selected></option>
                                                    <option
                                                        value="<?php echo TechnicianControllerClass::getAvailableTechnicians(); ?>">
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } elseif ($_SESSION['user_role'] === 'REQUESTOR') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="is_assigned_to" class="py-2 text-muted">CITRMU
                                                    PERSONEL:<span class="text-danger">*<span></label>
                                                <input type="text" class="form-control h-75 w-100 text-primary"
                                                    id="is_assigned_to" placeholder="PENDING"
                                                    name="is_assigned_to" value="PENDING" readonly>
                                            </div>
                                        </div>
                                        <div class="text-secondary ">CITRMU personel will be assigned by CITRMU
                                            department.</div>
                                    <?php } ?>

                                    <div class="d-flex gap-2 mt-5">
                                        <span class="fs-5 text-muted">
                                            Ticket's Details
                                        </span>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="service_request" class="py-2 text-muted">SERVICE/S
                                                REQUEST:<span class="text-danger">*</span></label>
                                            <select class="form-control h-75 w-100"
                                                aria-label="Default select example" name="service_request" placeholder="Service Request"
                                                id="service_request" required>
                                                <option
                                                    value="<?php echo TicketsControllerClass::getServices(); ?>"
                                                    selected></option>
                                            </select>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="ticket_subject"
                                                class="py-2 text-muted">SUBJECT:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="ticket_subject" placeholder="Network Connectivity Issue"
                                                name="ticket_subject" required>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="ticket_description"
                                                class="py-2 text-muted">DESCRIPTION:<span
                                                    class="text-danger">*</span></label>
                                            <textarea type="text" class="form-control h-100 w-100"
                                                id="ticket_description"
                                                placeholder="The network connectivity issues started at approximately 10:00 AM today. I have tried restarting my modem and router, but this has not resolved the problem. I have also tried connecting to different networks, but I am still unable to connect. I am able to connect to other devices on my local network, but I am unable to access the internet."
                                                name="ticket_description" required></textarea>
                                        </div>
                                    </div>

                                    <div class="text-secondary py-3">After you create a ticket, IT
                                        support will come to help you at the earliest opportunity. Please
                                        wait patiently.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mt-3 py-3 px-5 w-auto"
                                    name="add_account">CREATE TICKET</button>
                                <button type="button" class="btn btn-secondary mt-3 py-3 px-5 w-auto"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selectElement = document.getElementById('requestor_username');
                var uniqueIdField = document.getElementById('requestor_unique_id');
                var departmentField = document.getElementById('requestor_department');

                selectElement.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var uniqueId = selectedOption.getAttribute('data-unique-id');
                    var department = selectedOption.getAttribute('data-department');

                    uniqueIdField.value = uniqueId || ''; // Set to empty string if no value
                    departmentField.value = department || ''; // Set to empty string if no value
                });
            });
        </script>

        <!--END MODAL CREATE TICKET -->
        <!-- Modal completed-->
        <div class="modal fade" id="archivedUserModal" tabindex="-1"
            aria-labelledby="archivedUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class=" modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="archivedUserModalLabel">Completed Tickets
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body" style="height: 80vh; overflow-y: auto;">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">TICKET ID</th>
                                        <th scope="col">REQUESTED BY</th>
                                        <th scope="col">REQUESTED FROM</th>
                                        <th scope="col">SERVICE REQUEST</th>
                                        <th scope="col">TICKET SUBJECT</th>
                                        <th scope="col">TICKET DESCRIPTION</th>
                                        <th scope="col">TICKET ISSUED ON</th>
                                    </tr>
                                </thead>
                                <tbody class="p-5">
                                    <?php echo ticketsControllerClass::getCompletedTickets(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $sql = "SELECT * FROM tbl_tickets";
        $stmt = ConfigClass::prepareAndExecute($sql, []);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Access individual row data
            $unique_id = $row['unique_id'];
            $requestor_username = $row['requestor_username'];
            $requestor_unique_id = $row['requestor_unique_id'];
            $requestor_department = $row['requestor_department'];
            $service_request = $row['service_request'];
            $ticket_subject = $row['ticket_subject'];
            $ticket_description = $row['ticket_description'];
            $is_assigned_to = $row['is_assigned_to'];
            $created_at = $row['created_at'];
        }
        ?>
        <!-- Modal for Rating Form -->
        <div class="modal fade" id="ratingFormModal" tabindex="-1" aria-labelledby="ratingFormModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ratingFormModalLabel">🌟 Rate our Service</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../TS/backend/scripts/tickets/updateTickets-script.php"
                            method="post" enctype="multipart/form-data" class="p-3" style="width: 100%;">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-12 d-flex flex-column gap-4">
                                    <div class="d-flex gap-2">
                                        <span class="fs-5 text-muted">
                                            Requestor's Details
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="requestor_username"
                                                class="py-2 text-muted">REQUESTOR USERNAME:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_username" name="requestor_username"
                                                value="<?php echo $requestor_username; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_unique_id"
                                                class="py-2 text-muted">REQUESTOR ID:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_unique_id" name="requestor_unique_id"
                                                value="<?php echo $requestor_unique_id; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_department" class="py-2 text-muted">OFFICE
                                                / DEPARTMENT (REQUESTOR):<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_department" name="requestor_department"
                                                value="<?php echo $requestor_department; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER' || $_SESSION['user_role'] === 'REQUESTOR') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="is_assigned_to"
                                                    class="py-2 text-muted">TECHNICIAN:<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control h-75 w-100" name="is_assigned_to"
                                                    id="is_assigned_to" required>
                                                    <option value=" <?php echo $is_assigned_to; ?>" selected>
                                                        <?php echo $is_assigned_to; ?>
                                                    </option>
                                                </select>
                                            </div>
                                        <?php } ?>


                                        <div class="form-group w-100">
                                            <label for="service_request" class="py-2 text-muted">SERVICE/S
                                                REQUEST:<span class="text-danger">*</span></label>
                                            <select class="form-control h-75 w-100"
                                                aria-label="Default select example" name="service_request"
                                                id="service_request" required>
                                                <option value="<?php echo $service_request; ?>" selected>
                                                    <?php echo $service_request; ?>
                                                </option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="d-flex gap-2 mt-5">
                                            <span class="fs-5 text-muted">
                                                Ticket's Details
                                            </span>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="unique_id" class="py-2 text-muted">TICKET ID:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="unique_id" placeholder="<?php echo $unique_id; ?>"
                                                    name="unique_id" value="<?php echo $unique_id; ?>" readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="ticket_subject"
                                                    class="py-2 text-muted">SUBJECT:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="ticket_subject" value="<?php echo $ticket_subject; ?>"
                                                    name="ticket_subject" readonly>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="ticket_description"
                                                    class="py-2 text-muted">DESCRIPTION:<span
                                                        class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control h-100 w-100"
                                                    id="ticket_description"
                                                    placeholder="The network connectivity issues started at approximately 10:00 AM today. I have tried restarting my modem and router, but this has not resolved the problem. I have also tried connecting to different networks, but I am still unable to connect. I am able to connect to other devices on my local network, but I am unable to access the internet."
                                                    name="ticket_description"
                                                    readonly><?php echo $ticket_description; ?></textarea>
                                            </div>
                                        </div>

                                        <!--TICKET-->

                                        <body>
                                            <div class="d-flex gap-2 mt-5">
                                                <span class="fs-5 text-muted">
                                                    Rating Details
                                                </span>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <div class="form-group w-100">
                                                    <label for="ticket_timeliness" class="py-2 text-muted">
                                                        TIMELINESS<span class="text-danger">*</span><br>
                                                    </label>
                                                    <input type="number" class="form-control h-75 w-100"
                                                        id="ticket_timeliness" name="ticket_timeliness" required
                                                        min="1" max="5" step="1"
                                                        placeholder="PLEASE RATE THE SERVICE WITH 5 BEING THE HIGHEST & 1 BEING THE LOWEST."
                                                        oninput="restrictInput(this)" onkeydown="return restrictKeys(event)">
                                                </div>
                                                <div class="form-group w-100">
                                                    <label for="ticket_effectiveness" class="py-2 text-muted">
                                                        EFFECTIVENESS<span class="text-danger">*</span><br>
                                                    </label>
                                                    <input type="number" class="form-control h-75 w-100"
                                                        id="ticket_effectiveness" name="ticket_effectiveness" required
                                                        min="1" max="5" step="1"
                                                        placeholder="PLEASE RATE THE SERVICE WITH 5 BEING THE HIGHEST & 1 BEING THE LOWEST."
                                                        oninput="restrictInput(this)" onkeydown="return restrictKeys(event)">
                                                </div>
                                                <div class="form-group w-100">
                                                    <label for="ticket_overall_rate" class="py-2 text-muted">
                                                        HOW WOULD YOU RATE THE QUALITY OF SERVICE?<span class="text-danger">*</span><br>
                                                    </label>
                                                    <input type="number" class="form-control h-75 w-100"
                                                        id="ticket_overall_rate" name="ticket_overall_rate" required
                                                        min="1" max="5" step="1"
                                                        placeholder="PLEASE RATE THE SERVICE WITH 5 BEING THE HIGHEST & 1 BEING THE LOWEST."
                                                        oninput="restrictInput(this)" onkeydown="return restrictKeys(event)">
                                                </div>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <div class="form-group w-100">
                                                    <label for="ticket_feedback" class="py-2 text-muted">
                                                        FEEDBACK & SUGGESTIONS:<span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control h-100 w-100" id="ticket_feedback"
                                                        placeholder="I am very impressed with the services provided by the City Information Technology and Records Management Unit (CITRMU)..."
                                                        name="ticket_feedback"></textarea>
                                                </div>
                                            </div>

                                            <div class="text-info py-4">WE APPRECIATE YOUR RATING, THANK YOU.</div>

                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-primary mt-3 py-3 px-5 w-auto"
                                                    id="btn_rate_ticket" name="btn_rate_ticket">RATE TICKET</button>
                                                <button type="button" class="btn btn-secondary mt-3 py-3 px-5 w-auto"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                </div>

                                <script>
                                    function restrictInput(input) {
                                        let value = parseInt(input.value, 10);
                                        if (isNaN(value)) {
                                            input.value = '';
                                        } else if (value < 1) {
                                            input.value = 1;
                                        } else if (value > 5) {
                                            input.value = 5;
                                        }
                                    }

                                    function restrictKeys(event) {
                                        // Allow backspace, delete, tab, escape, and enter keys
                                        if (event.key === 'Backspace' || event.key === 'Delete' || event.key === 'Tab' || event.key === 'Escape' || event.key === 'Enter') {
                                            return;
                                        }

                                        // Allow arrow keys
                                        if (event.key.startsWith('Arrow')) {
                                            return;
                                        }

                                        // Allow number keys (0-9)
                                        if (event.key >= '0' && event.key <= '9') {
                                            return;
                                        }

                                        // Prevent other keys
                                        event.preventDefault();
                                    }
                                </script>
                                </body>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for Assigning Technician Form -->
        <div class="modal fade" id="assignFormModal" tabindex="-1" aria-labelledby="assignFormModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="assignFormModalLabel">Edit Ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../TS/backend/scripts/tickets/assignTech-script.php"
                            method="post" enctype="multipart/form-data" class="p-3" style="width: 100%;">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-12 d-flex flex-column gap-5">
                                    <div class="d-flex gap-2">
                                        <span class="fs-5 text-muted">
                                            Requestor's Details
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="requestor_username"
                                                class="py-2 text-muted">REQUESTOR USERNAME:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_username" name="requestor_username"
                                                value="<?php echo $requestor_username; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_unique_id"
                                                class="py-2 text-muted">REQUESTOR ID:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_unique_id" name="requestor_unique_id"
                                                value="<?php echo $requestor_unique_id; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_department" class="py-2 text-muted">OFFICE
                                                / DEPARTMENT (REQUESTOR):<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_department" name="requestor_department"
                                                value="<?php echo $requestor_department; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER' || $_SESSION['user_role'] === 'REQUESTOR') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="is_assigned_to"
                                                    class="py-2 text-muted">TECHNICIAN:<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control h-75 w-100" name="is_assigned_to"
                                                    id="is_assigned_to" required>
                                                    <option value=" " selected></option>
                                                    <option
                                                        value="<?php echo TechnicianControllerClass::getAvailableTechnicians(); ?>">
                                                    </option>
                                                </select>
                                            </div>
                                        <?php } ?>


                                        <div class="form-group w-100">
                                            <label for="service_request" class="py-2 text-muted">SERVICE/S
                                                REQUEST:<span class="text-danger">*</span></label>
                                            <select class="form-control h-75 w-100"
                                                aria-label="Default select example" name="service_request"
                                                id="service_request" required>
                                                <option value="<?php echo $service_request; ?>" selected>
                                                    <?php echo $service_request; ?>
                                                </option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="d-flex gap-2 mt-5">
                                            <span class="fs-5 text-muted">
                                                Ticket's Details
                                            </span>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="unique_id" class="py-2 text-muted">TICKET ID:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="unique_id" placeholder="<?php echo $unique_id; ?>"
                                                    name="unique_id" value="<?php echo $unique_id; ?>" readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="ticket_subject"
                                                    class="py-2 text-muted">SUBJECT:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="ticket_subject" value="<?php echo $ticket_subject; ?>"
                                                    name="ticket_subject" readonly>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="ticket_description"
                                                    class="py-2 text-muted">DESCRIPTION:<span
                                                        class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control h-100 w-100"
                                                    id="ticket_description"
                                                    placeholder="The network connectivity issues started at approximately 10:00 AM today. I have tried restarting my modem and router, but this has not resolved the problem. I have also tried connecting to different networks, but I am still unable to connect. I am able to connect to other devices on my local network, but I am unable to access the internet."
                                                    name="ticket_description"
                                                    readonly><?php echo $ticket_description; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="text-info py-3"> THANK YOU.</div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary mt-3 py-3 px-5 w-auto"
                                                id="btn_cancel_ticket" name="btn_rate_ticket">CANCEL TICKET</button>
                                            <button type="button"
                                                class="btn btn-secondary mt-3 py-3 px-5 w-auto"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for Edit Form -->
        <div class="modal fade" id="editFormModal" tabindex="-1" aria-labelledby="editFormModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editFormModalLabel">Edit Ticket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../TS/backend/scripts/tickets/assignTech-script.php"
                            method="post" enctype="multipart/form-data" class="p-3" style="width: 100%;">
                            <div class="d-flex flex-wrap">
                                <div class="col-md-12 d-flex flex-column gap-5">
                                    <div class="d-flex gap-2">
                                        <span class="fs-5 text-muted">
                                            Requestor's Details
                                        </span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <div class="form-group w-100">
                                            <label for="requestor_username"
                                                class="py-2 text-muted">REQUESTOR USERNAME:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_username" name="requestor_username"
                                                value="<?php echo $requestor_username; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_unique_id"
                                                class="py-2 text-muted">REQUESTOR ID:<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_unique_id" name="requestor_unique_id"
                                                value="<?php echo $requestor_unique_id; ?>" readonly>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="requestor_department" class="py-2 text-muted">OFFICE
                                                / DEPARTMENT (REQUESTOR):<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control h-75 w-100"
                                                id="requestor_department" name="requestor_department"
                                                value="<?php echo $requestor_department; ?>" readonly>
                                        </div>
                                    </div>

                                    <?php if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER' || $_SESSION['user_role'] === 'REQUESTOR') { ?>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="is_assigned_to"
                                                    class="py-2 text-muted">TECHNICIAN:<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control h-75 w-100" name="is_assigned_to"
                                                    id="is_assigned_to" required>
                                                    <option value=" " selected></option>
                                                    <option
                                                        value="<?php echo TechnicianControllerClass::getAvailableTechnicians(); ?>">
                                                    </option>
                                                </select>
                                            </div>
                                        <?php } ?>


                                        <div class="form-group w-100">
                                            <label for="service_request" class="py-2 text-muted">SERVICE/S
                                                REQUEST:<span class="text-danger">*</span></label>
                                            <select class="form-control h-75 w-100"
                                                aria-label="Default select example" name="service_request"
                                                id="service_request" required>
                                                <option value="<?php echo $service_request; ?>" selected>
                                                    <?php echo $service_request; ?>
                                                </option>
                                            </select>
                                        </div>
                                        </div>

                                        <div class="d-flex gap-2 mt-5">
                                            <span class="fs-5 text-muted">
                                                Ticket's Details
                                            </span>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="unique_id" class="py-2 text-muted">TICKET ID:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="unique_id" placeholder="<?php echo $unique_id; ?>"
                                                    name="unique_id" value="<?php echo $unique_id; ?>" readonly>
                                            </div>
                                            <div class="form-group w-100">
                                                <label for="ticket_subject"
                                                    class="py-2 text-muted">SUBJECT:<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control h-75 w-100"
                                                    id="ticket_subject" value="<?php echo $ticket_subject; ?>"
                                                    name="ticket_subject" readonly>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <div class="form-group w-100">
                                                <label for="ticket_description"
                                                    class="py-2 text-muted">DESCRIPTION:<span
                                                        class="text-danger">*</span></label>
                                                <textarea type="text" class="form-control h-100 w-100"
                                                    id="ticket_description"
                                                    placeholder="The network connectivity issues started at approximately 10:00 AM today. I have tried restarting my modem and router, but this has not resolved the problem. I have also tried connecting to different networks, but I am still unable to connect. I am able to connect to other devices on my local network, but I am unable to access the internet."
                                                    name="ticket_description"
                                                    readonly><?php echo $ticket_description; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="text-info py-3"> THANK YOU.</div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary mt-3 py-3 px-5 w-auto"
                                                id="btn_cancel_ticket" name="btn_rate_ticket">Assign a Technician</button>
                                            <button type="button"
                                                class="btn btn-secondary mt-3 py-3 px-5 w-auto"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>






</div>

</div>

</html>
</div>
</div>
</div>
<?php
include 'includes/_footer.php';
?>
</div>

<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<!--
<-->

</body>

</html>