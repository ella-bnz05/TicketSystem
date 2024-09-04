<?php

include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers\ticketsController.php';
include 'C:\xampp\htdocs\TS\controllers\serviceController.php';

// Retrieve the ID from either GET or POST request
$id = $_GET['id'] ?? $_POST['id'];

// Validate the ID to ensure it's an integer
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    // Handle invalid ID
    header('Location: /../../TS/ticket.php?alert=invalid_id');
    exit();
}

// Define the SQL query for hard delete
$sql = "DELETE FROM tbl_tickets WHERE id = :id";

// Prepare and execute the statement
try {
    $stmt = ConfigClass::prepareAndExecute($sql, ['id' => $id]);

    // Redirect to the desired page with a success alert
    header('Location: /../../TS/ticket.php?alert=ticket_deleted');
    exit(); // Ensure script execution stops
} catch (PDOException $e) {
    // Handle potential errors
    // Log the error message or handle it as appropriate
    error_log($e->getMessage());
    header('Location: /../../TS/ticket.php?alert=error_deleting_ticket');
    exit();
}
