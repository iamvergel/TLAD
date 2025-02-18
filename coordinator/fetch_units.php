<?php
include('authentication.php');
include('../admin/config/dbconn.php');

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    $stmt = $conn->prepare("SELECT * FROM unit WHERE department_id = ?");
    $stmt->bind_param('i', $department_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $units = [];
        while ($row = $result->fetch_assoc()) {
            $units[] = $row;
        }
        echo json_encode($units);
    } else {
        echo json_encode([]);
    }

    $stmt->close(); 
} else {
    echo json_encode([]); 
}