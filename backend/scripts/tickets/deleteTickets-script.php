<?php

include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers\ticketsController.php';
include 'C:\xampp\htdocs\TS\controllers\serviceController.php';

$id = $_GET['id'] ?? $_POST['id'];

// Insert the user data into the database
$sql = "UPDATE tbl_tickets SET is_deleted = 1 WHERE id = :id";

$stmt = ConfigClass::prepareAndExecute($sql, [
    'id' => $id
]);

// Redirect to the desired page
header('Location:/../../TS/ticket.php?alert=ticket_deleted');
exit(); // Ensure script execution stops
