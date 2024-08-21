<?php

include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers\ticketsController.php';
include 'C:\xampp\htdocs\TS\controllers\serviceController.php';

// Retrieve and sanitize form data
$ticket_unique_id = ServiceControllerClass::generateNumericID(16);
$requestor_username = ConfigClass::sanitizeInput($_POST['requestor_username']);
$requestor_unique_id = ConfigClass::sanitizeInput($_POST['requestor_unique_id']);
$requestor_department = ConfigClass::sanitizeInput($_POST['requestor_department']);
$service_request = ConfigClass::sanitizeInput($_POST['service_request']);
$ticket_subject = ConfigClass::sanitizeInput($_POST['ticket_subject']);
$ticket_description = ConfigClass::sanitizeInput($_POST['ticket_description']);
$is_assigned_to = ConfigClass::sanitizeInput($_POST['is_assigned_to']);

if ($is_assigned_to === '') {
    $is_assigned_to = '';
}

$sql_technician = "SELECT unique_id FROM tbl_users WHERE username = :technician_name";
$stmt_technician = ConfigClass::prepareAndExecute($sql_technician, [':technician_name' => $is_assigned_to]);
$technician_assigned_id = $stmt_technician->fetchColumn();

$ticket_timeliness = 0;
$ticket_effectiveness = 0;
$ticket_overall_rate = 0;
$ticket_feedback = " ";
$is_done = 0;
$is_deleted = 0;

// Insert the user data into the database
$sql = "INSERT INTO tbl_tickets (unique_id, requestor_username, requestor_unique_id, requestor_department, service_request, ticket_subject, ticket_description, is_assigned_to, technician_assigned_id, ticket_timeliness, ticket_effectiveness, ticket_overall_rate, ticket_feedback, is_done, is_deleted)
    VALUES (:ticket_unique_id, :requestor_username, :requestor_unique_id, :requestor_department, :service_request, :ticket_subject, :ticket_description, :is_assigned_to, :technician_assigned_id, :ticket_timeliness, :ticket_effectiveness, :ticket_overall_rate, :ticket_feedback, :is_done, :is_deleted)";

// Insert the user data into the database
$stmt = ConfigClass::prepareAndExecute($sql, [
    ':ticket_unique_id' => $ticket_unique_id,
    ':requestor_username' => $requestor_username,
    ':requestor_unique_id' => $requestor_unique_id,
    ':requestor_department' => $requestor_department,
    ':service_request' => $service_request,
    ':ticket_subject' => $ticket_subject,
    ':is_assigned_to' => $is_assigned_to,
    ':technician_assigned_id' => $technician_assigned_id,
    ':ticket_description' => $ticket_description,
    ':ticket_timeliness' => $ticket_timeliness,
    ':ticket_effectiveness' => $ticket_effectiveness,
    ':ticket_overall_rate' => $ticket_overall_rate,
    ':ticket_feedback' => $ticket_feedback,
    ':is_done' => $is_done,
    ':is_deleted' => $is_deleted
]);

// Redirect to the desired page
header('Location: /TS/testing.php?alert=new_ticket');
exit(); // Ensure script execution stops
