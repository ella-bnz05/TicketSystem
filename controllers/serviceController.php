<?php

class ServiceControllerClass
{

    public static function getServices(): string
    {
        $sql = "SELECT * FROM tbl_services WHERE is_deleted = 0 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['service_unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['service_creator_username'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['service_creator_unique_id'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['service_creator_department'] . '</td>';
            $html .= '<td class="py-3">' . $row['service_name'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/service/deleteServices-script.php?id=' . htmlspecialchars($row['id']) . '&alert=service_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-danger"><span class="material-symbols-outlined">delete</span>DELETE</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public static function getDeletedService(): string
    {
        $sql = "SELECT * FROM tbl_services WHERE is_deleted = 1 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">' . $row['service_unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['service_creator_username'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['service_creator_unique_id'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['service_creator_department'] . '</td>';
            $html .= '<td class="py-3">' . $row['service_name'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/service/restoreServices-script.php?id=' . htmlspecialchars($row['id']) . '&alert=service_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-info"><span class="material-symbols-outlined">replay</span>RESTORE</a>';
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

}