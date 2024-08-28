<?php

include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers\technicianController.php';

// Retrieve and sanitize form data
$technician_unique_id = TechnicianControllerClass::generateNumericID(16);
$technician_creator_username = ConfigClass::sanitizeInput($_POST['technician_creator_username']);
$technician_creator_unique_id = ConfigClass::sanitizeInput($_POST['technician_creator_unique_id']);
$technician_creator_department = ConfigClass::sanitizeInput($_POST['technician_creator_department']);
$technician_name = ConfigClass::sanitizeInput($_POST['technician_name']);
$is_assigned = 0;
$is_deleted = 0;


// Insert the user data into the database
$sql = "INSERT INTO tbl_technicians (technician_unique_id, technician_creator_username, technician_creator_unique_id, technician_creator_department, technician_name, is_assigned, is_deleted)
    VALUES (:technician_unique_id, :technician_creator_username, :technician_creator_unique_id, :technician_creator_department, :technician_name, :is_assigned, :is_deleted)";

// Insert the user data into the database
$stmt = ConfigClass::prepareAndExecute($sql, [
    ':technician_unique_id' => $technician_unique_id,
    ':technician_creator_username' => $technician_creator_username,
    ':technician_creator_unique_id' => $technician_creator_unique_id,
    ':technician_creator_department' => $technician_creator_department,
    ':technician_name' => $technician_name,
    ':is_assigned' => $is_assigned,
    ':is_deleted' => $is_deleted
]);

// Redirect to the desired page
header('Location: ../../../frontend/views/technician/index.php?alert=new_technician');
exit(); // Ensure script execution stops
