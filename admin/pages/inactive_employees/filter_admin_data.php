<?php
include('../../config/dbconn.php');

$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : '';
$unit_id = isset($_GET['unit_id']) ? $_GET['unit_id'] : '';

$whereClause = '';

if ($department_id) {
    $whereClause .= " AND tblemployee.Department = '$department_id'";
}

if ($unit_id) {
    $whereClause .= " AND tblemployee.UnitSection = '$unit_id'";
}

$sql = "
    SELECT 
        tblemployee.*, 
        department.name AS department_name, 
        unit.unit_name AS unit_name
    FROM tblemployee
    LEFT JOIN department ON tblemployee.Department = department.id
    LEFT JOIN unit ON tblemployee.UnitSection = unit.id
    WHERE tblemployee.Status = 0
    $whereClause
";

$query_run = mysqli_query($conn, $sql);

if (!$query_run) {
    die('Query Failed: ' . mysqli_error($conn));
}

// If no rows are returned
if (mysqli_num_rows($query_run) == 0) {
    echo '<tr><td colspan="8">No data available in table</td></tr>';
} else {
    // Loop through results and display
    while ($row = mysqli_fetch_array($query_run)) {
        echo '<tr>';
        echo '<td>' . $row['EmployeeNumber'] . '</td>';
        echo '<td>' . $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Suffix'] . '</td>';
        echo '<td>' . $row['ContactNumber'] . '</td>';
        echo ($row['Sex'] == 'F') ? "<td>Female</td>" : (($row['Sex'] == 'M') ? "<td>Male</td>" : "<td>Not Specified</td>");
        echo '<td>' . $row['Position'] . '</td>';
        echo '<td>' . $row['department_name'] . '</td>';
        echo '<td>' . $row['unit_name'] . '</td>';

        echo ($row['Status'] == 1)
            ? '<td><button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-success activatebtn">Active</button></td>'
            : '<td><button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button></td>';

        echo '<td>';
        echo '<button data-id="' . $row['EmployeeNumber'] . '" class="btn btn-sm btn-secondary viewEmployeebtn ml-1"><i class="fas fa-eye me-2"></i></button>';
        echo '</td>';
        echo '</tr>';
    }
}
