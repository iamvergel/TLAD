<?php
include('config/dbconn.php');  // Make sure to include the database connection

if (isset($_POST['department_id'])) {
    $department_id = $_POST['department_id'];

    // Fetch units based on the selected department
    $sql = "SELECT * FROM unit WHERE department_id = '$department_id'";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        // Output options for units
        echo "<option value=''>Select Unit</option>";
        while ($row = mysqli_fetch_assoc($query_run)) {
            echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
        }
    } else {
        echo "<option value=''>No units available</option>";
    }
}

if (isset($_POST['unit_id'])) {
    $unit_id = $_POST['unit_id'];

    // Fetch coordinators based on the selected unit
    $sql = "SELECT * FROM tblcoordinator WHERE unit_id = '$unit_id'";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        // Output options for coordinators
        echo "<option value=''>Select Coordinator</option>";
        while ($row = mysqli_fetch_assoc($query_run)) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
    } else {
        echo "<option value=''>No coordinators available</option>";
    }
}
?>