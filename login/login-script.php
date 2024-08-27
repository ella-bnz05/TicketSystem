<?php

session_start();
include 'C:\xampp\htdocs\TS\db\config.php';
//include '../../../TS/backend/db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_SignIn'])) {
    ConfigClass::sanitizeInput($username = $_POST['username']);
    ConfigClass::sanitizeInput($password = $_POST['password']);

    // Prepare the select statement
    $sql = "SELECT * FROM tbl_users WHERE username = :username AND is_deleted = 0";
    $stmt = ConfigClass::prepareAndExecute($sql, [':username' => $username]);

    // Get the user from the database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user does not exist, show an error message
    if (!$user) {
        echo "<script>window.location.href='" . ConfigClass::baseURL() . "login/login.php?alert=user_not_found';</script>";
    } else {
        // Verify the password using bcrypt
        if (password_verify($password, $user['password_hashed'])) {
            // The password is correct, log the user in

            // Store user data in session storage
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['unique_id'] = $user['unique_id'];
            $_SESSION['img_user_profile_picture'] = $user['img_user_profile_picture'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_department'] = $user['department'];

            // Redirect the user to the home page based on their role
            if ($user['role'] === 'ADMIN' || $user['role'] === 'MANAGER' || $user['role'] === 'REQUESTOR' || $user['role'] === 'TECHNICIAN') {
                header('Location: ' . ConfigClass::baseURL() . 'dashboard.php');
            } else {
                header('Location: ' . ConfigClass::baseURL() . 'login/login.php?alert=user_not_found');
            }
        } else {
            // Incorrect password, show an error message
            echo "<script>window.location.href='" . ConfigClass::baseURL() . "login/login.php?alert=incorrect_password';</script>";
        }
    }
}