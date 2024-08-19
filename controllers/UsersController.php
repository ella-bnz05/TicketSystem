<?php

class UsersControllerClass
{
    public static function getUsers(): string
    {
        $sql = "SELECT * FROM tbl_users WHERE role != 'ADMIN' AND is_deleted = 0 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';


        foreach ($result as $row) {

            $textColor = '';
            $role = $row['role'];
            if ($role === 'MANAGER') {
                $textColor = 'primary';
            } elseif ($role === 'REQUESTOR') {
                $textColor = 'secondary';
            } elseif ($role === 'TECHNICIAN') {
                $textColor = 'info';
            }

            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">
            <img class="avatar h-auto" style="width: 5rem;" src="../../../frontend/private/user-images/' . $row['unique_id'] . '/' . $row['img_user_profile_picture'] . '"</td>';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['username'] . '</td>';
            $html .= '<td class="py-3 text-' . $textColor . '">' . $row['role'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['department'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/user/deleteUsers-script.php?id=' . htmlspecialchars($row['id']) . '&alert=member_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-danger"><span class="material-symbols-outlined h-auto">delete</span>DELETE</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    public static function getDeletedUsers(): string
    {
        $sql = "SELECT * FROM tbl_users WHERE role != 'ADMIN' AND is_deleted = 1 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">
            <img class="avatar h-auto" style="width: 5rem;" src="../../../frontend/private/user-images/' . $row['unique_id'] . '/' . $row['img_user_profile_picture'] . '"</td>';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['username'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['role'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['department'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/user/restoreUsers-script.php?id=' . htmlspecialchars($row['id']) . '&alert=member_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-info"><span class="material-symbols-outlined">
replay
</span>RESTORE</a>';
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

    public static function getTickets(): string
    {
        $sql = "SELECT * FROM tbl_users WHERE role != 'ADMIN' AND is_deleted = 0 ORDER BY id DESC";
        $stmt = ConfigClass::prepareAndExecute($sql, []);
        $result = $stmt->fetchAll();

        $html = '';

        foreach ($result as $row) {
            $html .= '<tr class="text-center">';
            $html .= '<td class="py-3 text-muted">
            <img class="avatar h-auto" style="width: 5rem;" src="../../../frontend/private/user-images/' . $row['unique_id'] . '/' . $row['img_user_profile_picture'] . '"</td>';
            $html .= '<td class="py-3 text-muted">' . $row['unique_id'] . '</td>';
            $html .= '<td class="py-3 text-primary">' . $row['username'] . '</td>';
            $html .= '<td class="py-3 text-secondary">' . $row['role'] . '</td>';
            $html .= '<td class="py-3">' . $row['created_at'] . '</td>';
            $html .= '<td class="py-3">';
            // $html .= '<a href="../private/edit_member.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect member-details"><span class="material-symbols-outlined">search</span></a>';
            // $html .= '<a href="../private/edit_user.php?id=' . htmlspecialchars($row['id']) . '" class="btn hover-effect"><span class="material-symbols-outlined">edit</span></a>';
            $html .= '<a href="../../../backend/scripts/user/deleteUsers-script.php?id=' . htmlspecialchars($row['id']) . '&alert=member_deleted" class="btn hover-effect d-flex align-items-center gap-2 text-danger"><span class="material-symbols-outlined h-auto">delete</span>DELETE</a>';
            $html .= '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

}