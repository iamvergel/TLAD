<?php
include('../../config/dbconn.php');

// Ensure you return the filtered rows based on the selected parameters.
$department_id = $_GET['department_id'] ?? '';
$unit_id = $_GET['unit_id'] ?? '';
$year = $_GET['year'] ?? '';
$remarks = $_GET['remarks'] ?? '';

// Construct the WHERE clause based on the filters
$whereClause = "WHERE tblemployee.Status = 1";
if ($department_id)
    $whereClause .= " AND tblemployee.Department = '$department_id'";
if ($unit_id)
    $whereClause .= " AND tblemployee.UnitSection = '$unit_id'";
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
        tblemployeeremarks.Remarks AS Remarks
    FROM tblemployee
    LEFT JOIN department ON tblemployee.Department = department.id
    LEFT JOIN unit ON tblemployee.UnitSection = unit.id
    LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
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