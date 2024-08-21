<?php

include '../../../backend/config/config.php';
include '../../../backend/controllers/tickets/ticketsController.php';

// Retrieve and sanitize form data
$service_unique_id = TicketsControllerClass::generateNumericID(16);
$service_creator_username = ConfigClass::sanitizeInput($_POST['service_creator_username']);
$service_creator_unique_id = ConfigClass::sanitizeInput($_POST['service_creator_unique_id']);
$service_creator_department = ConfigClass::sanitizeInput($_POST['service_creator_department']);
$service_name = ConfigClass::sanitizeInput($_POST['service_name']);
$is_deleted = 0;


// Insert the user data into the database
$sql = "INSERT INTO tbl_services (service_unique_id, service_creator_username, service_creator_unique_id, service_creator_department, service_name, is_deleted)
    VALUES (:service_unique_id, :service_creator_username, :service_creator_unique_id, :service_creator_department, :service_name, :is_deleted)";

// Insert the user data into the database
$stmt = ConfigClass::prepareAndExecute($sql, [
    ':service_unique_id' => $service_unique_id,
    ':service_creator_username' => $service_creator_username,
    ':service_creator_unique_id' => $service_creator_unique_id,
    ':service_creator_department' => $service_creator_department,
    ':service_name' => $service_name,
    ':is_deleted' => $is_deleted
]);

// Redirect to the desired page
header('Location: ../../../frontend/views/service/index.php?alert=new_service');
exit(); // Ensure script execution stops
