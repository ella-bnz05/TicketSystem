<?php

class TicketsControllerClass
{
    public static function getServices(): string
    {
        $sql = "SELECT * FROM tbl_services";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<option value="' . $row['service_name'] . '" selected>' . $row['service_name'] . ' </option>';
        }

        return $html;
    }

    public static function getCompletedTickets(): string
    {
        $sql = "SELECT * FROM tbl_tickets WHERE is_done = 1 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['requestor_username'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['requestor_department'] . '</td>';
            $html .= '<td class="py-3">' . $row['service_request'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_subject'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_description'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/user/restoreUsers-script.php?id=' . htmlspecialchars($row['id']) . '&alert=member_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-info"><span class="material-symbols-outlined">replay</span>RESTORE</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public static function generateNumericID($length): string
    {
        date_default_timezone_set("Asia/Manila");

        // Get the current time in 12-hour format
        $current_time = date('Y-m-d');

        // Generate a random numeric string of specified length
        $random_number = '';
        for ($i = 0; $i < $length; $i++) {
            $random_number .= mt_rand(0, 9);
        }

        // Combine the current time and random number with a hyphen (-)
        return $current_time . '-' . $random_number;
    }

    public static function getTicketsDashboardIndex(): string
    {
        $currentUserID = $_SESSION['unique_id'];

        if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER') {
            $sql = "SELECT * FROM tbl_tickets WHERE is_done = 0 AND is_deleted = 0 ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, []);
        }

        if ($_SESSION['user_role'] === 'REQUESTOR') {
            $sql = "SELECT * FROM tbl_tickets WHERE is_done = 1 AND is_deleted = 0 AND requestor_unique_id = :currentUserID ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, [':currentUserID' => $currentUserID]);
        }

        if ($_SESSION['user_role'] === 'TECHNICIAN') {
            $sql = "SELECT * FROM tbl_tickets WHERE (is_done = 1 OR is_done = 0) AND is_deleted = 0 AND technician_assigned_id = :currentUserID ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, [':currentUserID' => $currentUserID]);
        }

        $result = $stmt->fetchAll();
        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['requestor_username'] . '</td>';
            $html .= '<td class="py-3">' . $row['requestor_department'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['is_assigned_to'] . '</td>';
            $html .= '<td class="py-3">' . $row['service_request'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_subject'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_description'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';

            // Dropdown button to provide more options
            $html .= '<div class="dropdown">';
            $html .= '<button class="btn hover-effect d-flex align-items-center gap-2 text-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $html .= '<span class="material-symbols-outlined h-auto">settings</span>';
            $html .= '</button>';
            $html .= '<div class="dropdown-menu">';

            if ($_SESSION['user_role'] === 'TECHNICIAN') {
                $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myRateModal"' . $row['id'] . '">MyRATE</a>';
            }

            $html .= '</td>';

            // if ($_SESSION['user_role'] === 'ADMIN') {
            //     // Add the "Rate" option in the dropdown
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';

            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">EDIT</a>';
            // }

            // if ($_SESSION['user_role'] === 'REQUESTOR') {
            //     // Add the "Rate" option in the dropdown
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';
            // }

            // if ($_SESSION['user_role'] === 'MANAGER') {
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">EDIT</a>';
            // }


        }

        return $html;
    }

    public static function technicianRate(): string
    {
        $currentUserID = $_SESSION['unique_id'];

        if ($_SESSION['user_role'] === 'TECHNICIAN') {
            $sql = "SELECT * FROM tbl_tickets WHERE (is_done = 1 OR is_done = 0) AND is_deleted = 0 AND technician_assigned_id = :currentUserID ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, [':currentUserID' => $currentUserID]);
        }

        $result = $stmt->fetchAll();
        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_subject'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_description'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_timeliness'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_effectiveness'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_overall_rate'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_feedback'] . '</td>';
            // $html .= '<td class="py-3">';

            // // Dropdown button to provide more options
            // $html .= '<div class="dropdown">';
            // $html .= '<button class="btn hover-effect d-flex align-items-center gap-2 text-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            // $html .= '<span class="material-symbols-outlined h-auto">settings</span>';
            // $html .= '</button>';
            // $html .= '<div class="dropdown-menu">';

            // if ($_SESSION['user_role'] === 'TECHNICIAN') {
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#myRateModal"' . $row['id'] . '">MyRATE</a>';
            // }

            // $html .= '</td>';

            // if ($_SESSION['user_role'] === 'ADMIN') {
            //     // Add the "Rate" option in the dropdown
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';

            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">EDIT</a>';
            // }

            // if ($_SESSION['user_role'] === 'REQUESTOR') {
            //     // Add the "Rate" option in the dropdown
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';
            // }

            // if ($_SESSION['user_role'] === 'MANAGER') {
            //     $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">EDIT</a>';
            // }


        }

        return $html;
    }

    public static function getTicketsTicketsIndex(): string
    {
        $currentUserID = $_SESSION['unique_id'];

        if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER') {
            $sql = "SELECT * FROM tbl_tickets WHERE is_done = 0 AND is_deleted = 0 ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, []);
        }

        if ($_SESSION['user_role'] === 'REQUESTOR') {
            $sql = "SELECT * FROM tbl_tickets WHERE is_done = 0 AND is_deleted = 0 AND requestor_unique_id = :currentUserID ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, [':currentUserID' => $currentUserID]);
        }

        if ($_SESSION['user_role'] === 'TECHNICIAN') {
            $sql = "SELECT * FROM tbl_tickets WHERE is_done = 0 AND is_deleted = 0 AND technician_assigned_id = :currentUserID ORDER BY id DESC";
            $stmt = ConfigClass::prepareAndExecute($sql, [':currentUserID' => $currentUserID]);
        }

        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['requestor_username'] . '</td>';
            $html .= '<td class="py-3">' . $row['requestor_department'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['is_assigned_to'] . '</td>';
            $html .= '<td class="py-3">' . $row['service_request'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_subject'] . '</td>';
            $html .= '<td class="py-3">' . $row['ticket_description'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';

            // Dropdown button to provide more options
            $html .= '<div class="dropdown">';
            $html .= '<button class="btn hover-effect d-flex align-items-center gap-2 text-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $html .= '<span class="material-symbols-outlined h-auto">settings</span>';
            $html .= '</button>';
            $html .= '<div class="dropdown-menu">';

            if ($_SESSION['user_role'] === 'ADMIN') {
                // Add the "Rate" option in the dropdown
                $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';

                $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">EDIT</a>';
            }

            if ($_SESSION['user_role'] === 'REQUESTOR') {
                // Add the "Rate" option in the dropdown
                $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">RATE</a>';
            }

            if ($_SESSION['user_role'] === 'ADMIN' || $_SESSION['user_role'] === 'MANAGER') {
                $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#assignTechnicianFormModal"' . $row['id'] . '">ASSIGN A TECHNICIAN</a>';
            }


        }

        return $html;
    }

}