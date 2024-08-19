<?php

include '../../../backend/config/config.php';
include '../../../backend/controllers/user/usersController.php';

// Get the user id from the URL or POST data
$user_id = $_GET['id'] ?? $_POST['id'];

// Insert the user data into the database
$sql = "UPDATE tbl_users SET is_deleted = 0 WHERE id = :user_id"; // Add a WHERE clause and a placeholder for the user id

$stmt = ConfigClass::prepareAndExecute($sql, [
    'user_id' => $user_id
]);

// Redirect to the desired page
header('Location: ../../../frontend/views/user/index.php?alert=member_restored');
exit(); // Ensure script execution stops
