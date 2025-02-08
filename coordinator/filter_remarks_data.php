<?php
include('authentication.php');
include('../admin/config/dbconn.php');

// Ensure you return the filtered rows based on the selected parameters.
$year = $_GET['year'] ?? '';
$remarks = $_GET['remarks'] ?? '';

$user = $_SESSION['auth_user']['user_id'];

// Construct the WHERE clause based on the filters
$whereClause = "WHERE tblemployee.Status = 1 AND tblemployee.coordinator_id = $user";
if ($year)
    $whereClause .= " AND tblemployeeremarks.Year = '$year'";
if ($remarks !== '')
    $whereClause .= " AND tblemployeeremarks.Remarks = '$remarks'";

// Final query with dynamic filters
$sql = "
   SELECT 
    tblemployee.*, 
    department.name AS department_name, 
    unit.unit_name AS unit_name,
    tblemployeeremarks.Remarks As Remarks,
    tblemployeeseminar.Title As Title
    FROM tblemployee
    LEFT JOIN department ON tblemployee.Department = department.id
    LEFT JOIN unit ON tblemployee.UnitSection = unit.id
    LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
    LEFT JOIN tblemployeeseminar ON tblemployee.EmployeeNumber = tblemployeeseminar.EmployeeNumber
    $whereClause
";

$query_run = mysqli_query($conn, $sql);
if ($query_run) {
    while ($row = mysqli_fetch_array($query_run)) {
        // Output table rows
        echo '<tr>';
        echo '<td>' . $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Suffix'] . '</td>';
        echo '<td>' . $row['Position'] . '</td>';
        echo '<td>' . $row['department_name'] . '</td>';
        echo '<td>' . $row['unit_name'] . '</td>';
        echo '<td>' . $row['Title'] . '</td>';
        echo '<td>';
        if ($row['Remarks'] == '1') {
            // Green for "WITH TRAINING"
            echo "<span class='text-success' style='font-weight: bold;'>WITH TRAINING</span>";
        } elseif ($row['Remarks'] == '0') {
            // Red for "WITHOUT TRAINING"
            echo "<span class='text-danger' style='font-weight: bold;'>WITHOUT TRAINING</span>";
        } else {
            echo 'Not Specified';
        }
        echo '</td>';

    }
}