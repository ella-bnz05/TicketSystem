<?php

include 'C:\xampp\htdocs\TS\db\config.php';
include 'C:\xampp\htdocs\TS\controllers\UsersController.php';

// Retrieve and sanitize form data
$unique_id = UsersControllerClass::generateNumericID(16);
$role = ConfigClass::sanitizeInput($_POST['role']);
$username = ConfigClass::sanitizeInput($_POST['username']);
$password = ConfigClass::sanitizeInput($_POST['password']);
$department = ConfigClass::sanitizeInput($_POST['department']);
$is_deleted = 0;
// Create a unique folder for the member's pictures
$userProfilePictureFolder = '../../user-images/' . $unique_id;
if (!file_exists($userProfilePictureFolder)) {
    mkdir($userProfilePictureFolder, 0777, true);
}

// Upload Profile Picture
$profile_picture = $_FILES['profile_picture']['name'];
$profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];

//Profile Picture File Name is User UniqueID
$file_info = pathinfo($_FILES['profile_picture']['name']);
$file_extension = $file_info['extension'];
$profilePictureFilename = $unique_id . '.' . $file_extension;


// Set the actual path
$profile_picture_path = $userProfilePictureFolder . '/' . $profilePictureFilename;
move_uploaded_file($profile_picture_tmp, $profile_picture_path);

// Hash the password using Bcrypt
$password_hashed = password_hash($password, PASSWORD_BCRYPT);

// Insert the user data into the database
$sql = "INSERT INTO tbl_users (unique_id, username, password_hashed, role, department, img_user_profile_picture, is_deleted)
    VALUES (:unique_id, :username, :password_hashed, :role, :department, :img_user_profile_picture, :is_deleted)";

// Insert the user data into the database
$stmt = ConfigClass::prepareAndExecute($sql, [
    ':unique_id' => $unique_id,
    ':username' => $username,
    ':password_hashed' => $password_hashed,
    ':role' => $role,
    ':department' => $department,
    ':img_user_profile_picture' => $profilePictureFilename,
    ':is_deleted' => $is_deleted
]);

// Redirect to the desired page

header('Location: /../../TS/user_management.php?alert=new_member');
exit(); // Ensure script execution stops
