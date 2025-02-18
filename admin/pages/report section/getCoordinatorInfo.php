<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_SESSION['auth'])) {
    $userId = $_SESSION['auth_user']['user_id'];

    // Fixing the SQL query syntax by removing the trailing comma
    $sql = "SELECT 
                tbladmin.name AS admin_name,
                tbladmin.address,
                tbladmin.division_head_name
            FROM tbladmin
            WHERE tbladmin.id = '$userId'";

    $query_run = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($query_run)) {
        echo json_encode([
            'admin_name' => $row['admin_name'],
            'address' => $row['address'],
            'division_head_name' => $row['division_head_name'],
        ]);
    } else {
        echo json_encode(['error' => 'Coordinator not found']);
    }
} else {
    echo json_encode(['error' => 'User not authenticated']);
}
?>
