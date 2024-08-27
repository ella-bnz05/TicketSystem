<?php

class DashboardControllerClass
{
    public static function getUsersCount(): void
    {
        $sql = "SELECT COUNT(*) FROM tbl_users";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        // Fetch the count as a string
        $count = $stmt->fetchColumn();
        echo $count;
    }

    public static function getOverallTickets(): void
    {
        $sql = "SELECT COUNT(*) FROM tbl_tickets WHERE is_deleted = 0";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        // Fetch the count as a string
        $count = $stmt->fetchColumn();
        echo $count;
    }

    public static function getTechnician(): int
    {
        $sql = "SELECT * FROM tbl_users WHERE role = 'TECHNICIAN'";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $count = $stmt->rowCount();
        return $count;
    }

    public static function getServices(): void
    {
        $sql = "SELECT COUNT(*) FROM tbl_services";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $count = $stmt->fetchColumn();
        echo $count;
    }

    public static function getTicketsCompleted(): void
    {
        $sql = "SELECT COUNT(*) FROM tbl_tickets WHERE is_done = 1";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $count = $stmt->fetchColumn();
        echo $count;
    }

    public static function getTechnicianOverallTicketCount(): void
    {
        $sql = "SELECT is_assigned_to, COUNT(*) as total_rows FROM tbl_tickets WHERE is_done = 1 GROUP BY is_assigned_to";

        $results = ConfigClass::prepareAndExecute($sql, []);

        // Start the container outside the loop
        echo '<div class="mb-5 bg-light" style="width: fit-content; height: fit-content;">';

        // Get the number of rows returned by the query
        $num_rows = $results->rowCount();

        // Check if there is any data available
        if ($num_rows == 0) {
            // Display a message saying "No Data Available" and center it
            echo '<div class="card-body d-flex gap-3 align-items-center justify-contents-center btn fs-4 border border-muted rounded p-3 mb-5"
        style="width: fit-content; height: fit-content; text-align: center;">
            <span class="px-2 fs-6">No Data Available</span>
        </div>';
        } else {
            // Iterate through the results and add each row to the table
            foreach ($results as $row) {
                echo '
        <div class="card-body d-flex gap-3 align-items-center justify-contents-center btn fs-4 border border-muted rounded p-3 mb-5"
        style="width: fit-content; height: fit-content;">
            <span class="px-2 fs-6">' . $row['is_assigned_to'] . ': ' . $row['total_rows'] . '</span>
        </div>';
            }
        }

        // Close the container after the loop
        echo '</div>';
    }

}

