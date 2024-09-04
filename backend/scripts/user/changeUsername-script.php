<?php

include '../../../backend/db/config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if id parameter is set in URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $username = ConfigClass::sanitizeInput($_POST['username']);

        // prepare the SQL statement
        $sql = "UPDATE tbl_users SET username = :username WHERE id = :id";

        $stmt = ConfigClass::prepareAndExecute($sql, [':username' => $username, ':id' => $id]);

        // Execute the statement
        if ($stmt) {
            // Check if the SQL update statement was successful
            if ($stmt->rowCount() === 1) {
                // Redirect user back to the previous page
                // echo '<script>alert("Account username has been updated successfully.");</script>';
                // echo '<script>history.go(-1);</script>';
                header('Location: ../../../user-profile.php?alert=username_updated');
            } else {
                // Handle the error case when the specified column is invalid
                echo "<script>alert('Error updating username.');</script>";
            }
        } else {
            // Handle the case when the SQL statement execution fails
            echo "<script>alert('Error executing SQL statement.');</script>";
        }
    }
}
