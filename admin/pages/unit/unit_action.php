<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_POST['insert_unit'])) {
    $unit_name = $_POST['name'];
    $department_id = $_POST['department_id'];

    // Check if the fields are not empty
    if (!empty($unit_name) && !empty($department_id)) {
        // Prepare the SQL statement to insert the unit into the unit table
        $sql = "INSERT INTO unit (unit_name, department_id) VALUES (?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters ('s' for string, 'i' for integer)
        mysqli_stmt_bind_param($stmt, "si", $unit_name, $department_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Unit Added Successfully";
            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Unit Addition Unsuccessful: " . mysqli_error($conn);
            header('Location: index.php');
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "Please fill in all fields";
        header('Location: index.php');
    }
}

// Assuming the ID is coming from the AJAX request
if (isset($_POST['checking_unit'])) {
    $unitId = $_POST['unit_id'];
    $sql = "SELECT * FROM unit WHERE id = '$unitId'";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        $unit = mysqli_fetch_assoc($query_run);
        echo json_encode([$unit]);  // Return the unit data as an array
    } else {
        echo json_encode([]);  // Return an empty array if no data is found
    }
}

if (isset($_POST['update_unit'])) {
    $unit_id = $_POST['edit_id'];
    $unit_name = $_POST['unit_name'];
    $department_id = $_POST['department_id'];

    // Validate the input
    if (!empty($unit_name) && !empty($department_id)) {
        // Prepare the SQL query to update the unit
        $sql = "UPDATE unit SET unit_name='$unit_name', department_id='$department_id' WHERE id='$unit_id'";
        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            $_SESSION['success'] = "Unit Updated Successfully";
            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Unit Update Unsuccessful";
            header('Location: index.php');
        }
    } else {
        $_SESSION['error'] = "Please fill in all fields";
        header('Location: index.php');
    }
}

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];  // Get the ID of the unit to delete

    // Delete the unit by ID
    $sql = "DELETE FROM unit WHERE id='$id' LIMIT 1";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Unit Deleted Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "Unit Deletion Unsuccessful: " . mysqli_error($conn);
        header('Location:index.php');
    }
}