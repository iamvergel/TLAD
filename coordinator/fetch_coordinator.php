<?php
include('authentication.php');
include('../admin/config/dbconn.php');

if (isset($_GET['unit_id'])) {
    $unit_id = $_GET['unit_id'];

    $stmt = $conn->prepare("SELECT * FROM tblcoordinator WHERE unit_id = ?");
    $stmt->bind_param('i', $unit_id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $coordinators = [];
        while ($row = $result->fetch_assoc()) {
            $coordinators[] = $row;
        }
        echo json_encode($coordinators);  
    } else {
        echo json_encode([]); 
    }

    $stmt->close(); 
} else {
    echo json_encode([]); 
}