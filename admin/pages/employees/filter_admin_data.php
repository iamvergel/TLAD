<?php
include('../../config/dbconn.php');

$department_id = isset($_GET['department_id']) ? $_GET['department_id'] : '';
$unit_id = isset($_GET['unit_id']) ? $_GET['unit_id'] : '';

$whereClause = " WHERE tblemployee.Status = 1";

$i = 1;

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
    $whereClause
";

$query_run = mysqli_query($conn, $sql);

if (!$query_run) {
    die('Query Failed: ' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($query_run)) {
    echo '<tr>';
    echo '<td>' . $i++ . '</td>';
    echo '<td>' . $row['EmployeeNumber'] . '</td>';
    echo '<td>' . $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Suffix'] . '</td>';
    echo '<td>' . $row['ContactNumber'] . '</td>';
    if ($row['Sex'] == 'F') {
        echo "<td>Female</td>";
    } elseif ($row['Sex'] == 'M') {
        echo "<td>Male</td>";
    } else {
        echo "<td>Not Specified</td>";
    }
    echo '<td>' . $row['Position'] . '</td>';
    echo '<td>' . $row['department_name'] . '</td>';
    echo '<td>' . $row['unit_name'] . '</td>';

    if ($row['Status'] == 1) {
        echo '<td><button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-success activatebtn">Active</button></td>';
    } else {
        echo '<td><button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button></td>';
    }

    echo '<td>';
    echo '<button title="Upload Certificate" data-id="' . $row['EmployeeNumber'] . '"
          data-Firstname="' . $row['Firstname'] . '"
          data-Middlename="' . $row['Middlename'] . '"
          data-Lastname="' . $row['Lastname'] . '" data-Suffix="' . $row['Suffix'] . '"
          class="btn btn-sm btn-primary uploadCertificate"><i class="fas fa-upload me-2"></i></button>';
    echo '<a title="View Employee" href="employee_info.php?EmployeeNumber=' . $row["EmployeeNumber"] . '"
          class="btn btn-sm btn-secondary ml-1"><i class="fas fa-eye me-2"></i></a>';
    echo '<button title="Edit Employee" data-id="' . $row['id'] . '" class="btn btn-sm btn-info editEmployeebtn ml-1"><i class="fas fa-edit"></i></button>';
    echo '</td>';
    echo '</tr>';
}