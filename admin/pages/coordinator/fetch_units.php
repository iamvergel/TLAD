<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];
    
    // Query to fetch units based on the department_id
    $sql = "SELECT * FROM unit WHERE department_id = '$department_id'";
    $query_run = mysqli_query($conn, $sql);

    // Check if there are units in the database
    if (mysqli_num_rows($query_run) > 0) {
        $units = [];
        while ($row = mysqli_fetch_assoc($query_run)) {
            $units[] = $row;
        }
        echo json_encode($units); // Return units as JSON
    } else {
        echo json_encode([]); // Return empty array if no units found
    }
} else {
    echo json_encode([]); // Return empty array if no department_id is set
}