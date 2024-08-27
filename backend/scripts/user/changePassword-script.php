<?php

include '../../../backend/db/config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if id parameter is set in URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $password = ConfigClass::sanitizeInput($_POST['password']);
        $confirmPassword = ConfigClass::sanitizeInput($_POST['confirmPassword']);

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "<script>alert('Error: Passwords do not match.');</script>";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // prepare the SQL statement
            $sql = "UPDATE tbl_users SET password_hashed = :password WHERE id = :id";

            $stmt = ConfigClass::prepareAndExecute($sql, [':password' => $hashedPassword, ':id' => $id]);

            // Execute the statement
            if ($stmt) {
                // Check if the SQL update statement was successful
                if ($stmt->rowCount() === 1) {
                    // Redirect user back to the previous page
                    // echo '<script>alert("Account password has been updated successfully.");</script>';
                    // echo '<script>history.go(-1);</script>';
                    header('Location: ../../../user-profile.php?alert=password_updated');
                } else {
                    // Handle the error case when the specified column is invalid
                    echo "<script>alert('Error updating password.');</script>";
                }
            } else {
                // Handle the case when the SQL statement execution fails
                echo "<script>alert('Error executing SQL statement.');</script>";
            }
        }
    }
}
