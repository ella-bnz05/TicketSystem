<?php

include '../../../backend/config/config.php';


$id = $_GET['id'] ?? $_POST['id'];

// Insert the user data into the database
$sql = "UPDATE tbl_services SET is_deleted = 1 WHERE id = :id";

$stmt = ConfigClass::prepareAndExecute($sql, [
    'id' => $id
]);

// Redirect to the desired page
header('Location: ../../../frontend/views/service/index.php?alert=service_deleted');
exit(); // Ensure script execution stops
