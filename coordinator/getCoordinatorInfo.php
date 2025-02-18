<?php
include('authentication.php');
include('../admin/config/dbconn.php');

if (isset($_SESSION['auth'])) {
    $userId = $_SESSION['auth_user']['user_id'];

    $sql = "SELECT 
                tblcoordinator.name AS coordinator_name,
                tblcoordinator.division_head_name,
                tblcoordinator.unit_section_head_name,
                department.name AS department_name,
                unit.unit_name AS unit_name
            FROM tblcoordinator
            LEFT JOIN department ON tblcoordinator.division_id = department.id
            LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
            WHERE tblcoordinator.id = '$userId'";

    $query_run = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($query_run)) {
        echo json_encode([
            'coordinator_name' => $row['coordinator_name'],
            'division_head_name' => $row['division_head_name'],
            'unit_section_head_name' => $row['unit_section_head_name'],
            'department_name' => $row['department_name'],
            'unit_name' => $row['unit_name']
        ]);
    } else {
        echo json_encode(['error' => 'Coordinator not found']);
    }
} else {
    echo json_encode(['error' => 'User not authenticated']);
}
?>
