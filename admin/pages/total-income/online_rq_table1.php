<?php
include('../../config/dbconn.php');

// SQL query to fetch daily income details from both tblappointment and tblwalkinappointment
$sql = "
    SELECT
        patient_id,
        patient_name,
        created_at,
        schedule,
        starttime,
        endtime,
        payment,
        payment_option,
        status,
        id,
        patient_id
    FROM tblappointment a
    JOIN tblappointment p ON a.patient_id = p.id
    WHERE a.schedtype = 'Online Schedule'
    UNION ALL
    SELECT
    patient_id,
        patient_name,
        created_at,
        schedule,
        starttime,
        endtime,
        payment,
        payment_option,
        status,
        id,
        patient_id
    FROM tblwalkinappointment w
    JOIN tblwalkinappointment p ON w.patient_id = p.id
";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
if (!$result) {
    // Output detailed error message
    $error_message = mysqli_error($conn);
    echo json_encode([
        'error' => 'Query Failed: ' . $error_message,
    ]);
    exit;
}

// Store the fetched data
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Output the data in JSON format
echo json_encode([
    "draw" => intval($_POST['draw']),
    "recordsTotal" => count($data),
    "recordsFiltered" => count($data),
    "data" => $data
]);
