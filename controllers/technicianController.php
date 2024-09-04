<?php

class TechnicianControllerClass
{

    public static function getDeletedTickets(): string
    {
        $sql = "SELECT * FROM tbl_technicians WHERE is_deleted = 1 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['technician_unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_username'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_department'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['technician_name'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';

            // Dropdown button to provide more options
            $html .= '<div class="dropdown">';
            $html .= '<button class="btn hover-effect d-flex align-items-center gap-2 text-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $html .= '<span class="material-symbols-outlined h-auto">settings</span>';
            $html .= '</button>';
            $html .= '<div class="dropdown-menu">';

            // Add the "Rate" option in the dropdown
            // $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">Rate</a>';
            $html .= '<a href="/TS/backend/scripts/technician/restoreTechnician-script.php?id=' . htmlspecialchars($row['id']) . '&alert=service_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-info dropdown-item"><span class="material-symbols-outlined">replay</span>RESTORE</a>';

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

    public static function getTechnician(): string
    {
        $sql = "SELECT * FROM tbl_technicians WHERE is_deleted = 0 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['technician_unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_username'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_unique_id'] . '</td>';
            $html .= '<td class="py-3">' . $row['technician_creator_department'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['technician_name'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';

            // Dropdown button to provide more options
            $html .= '<div class="dropdown">';
            $html .= '<button class="btn hover-effect d-flex align-items-center gap-2 text-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $html .= '<span class="material-symbols-outlined h-auto">settings</span>';
            $html .= '</button>';
            $html .= '<div class="dropdown-menu">';

            // Add the "Rate" option in the dropdown
            // $html .= '<a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ratingFormModal"' . $row['id'] . '">Rate</a>';
            $html .= '<a href="/TS/backend/scripts/technician/deleteTechnician-script.php?id=' . htmlspecialchars($row['id']) . '&alert=service_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-danger dropdown-item"><span class="material-symbols-outlined">delete</span>DELETE</a>';


        }

        return $html;
    }

    public static function getAvailableTechnicians(): string
    {
        $sql = "SELECT unique_id, username FROM tbl_users u WHERE u.role = 'TECHNICIAN'
         AND NOT EXISTS (SELECT 1 FROM tbl_tickets t WHERE t.is_assigned_to = u.username AND t.is_done = 0)";

        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<option value="' . $row['username'] . '">' . $row['username'] . ' </option>';
        }

        return $html;
    }

}