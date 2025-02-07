<?php
include('authentication.php');
include('../admin/config/dbconn.php');

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM unit WHERE department_id = ?");
    $stmt->bind_param('i', $department_id);  // 'i' denotes integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $units = [];
        while ($row = $result->fetch_assoc()) {
            $units[] = $row;
        }
        echo json_encode($units);  // Send units as a JSON response
    } else {
        echo json_encode([]);  // If no units found, return an empty array
    }

    $stmt->close();  // Close the statement
} else {
    echo json_encode([]);  // If no department_id is passed, return an empty array
}