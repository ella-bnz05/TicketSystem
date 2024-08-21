<?php

include '../../../backend/config/config.php';

// Get the user id from the URL or POST data
$id = $_GET['id'] ?? $_POST['id'];

// Insert the user data into the database
$sql = "UPDATE tbl_services SET is_deleted = 0 WHERE id = :id"; // Add a WHERE clause and a placeholder for the user id

$stmt = ConfigClass::prepareAndExecute($sql, [
    'id' => $id
]);

// Redirect to the desired page
header('Location: ../../../frontend/views/service/index.php?alert=service_restored');
exit(); // Ensure script execution stops
