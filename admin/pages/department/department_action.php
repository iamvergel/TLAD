    <?php
    include('../../authentication.php');
    include('../../config/dbconn.php');

    if (isset($_POST['insert_department'])) {
        $name = $_POST['name'];  // Only handle name field since your database only has name and id

        // Check if the name is not empty
        if ($name != NULL) {
            $sql = "INSERT INTO department (name) VALUES ('$name')";
            $query_run = mysqli_query($conn, $sql);

            if ($query_run) {
                $_SESSION['success'] = "Department Added Successfully";
                header('Location: index.php');
            } else {
                $_SESSION['error'] = "Department Addition Unsuccessful";
                header('Location: index.php');
            }
        }
    }

    if (isset($_POST['checking_department'])) {
        $id = $_POST['department_id']; // Corrected to match the frontend
        $result_array = [];

        $sql = "SELECT * FROM department WHERE id='$id'";
        $query_run = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                array_push($result_array, $row);
            }
            header('Content-type: application/json');
            echo json_encode($result_array);
        } else {
            echo "<h5>No Record Found</h5>";
        }
    }

    if (isset($_POST['update_department'])) {
        $id = $_POST['edit_id'];
        $name = $_POST['name']; // Only handle the name field

        if ($_SESSION['error'] == '') {
            $sql = "UPDATE department SET name='$name' WHERE id='$id'";
            $query_run = mysqli_query($conn, $sql);

            if ($query_run) {
                $_SESSION['success'] = "Department Updated Successfully";
                header('Location: index.php');
            } else {
                $_SESSION['error'] = "Department Update Unsuccessful";
                header('Location: index.php');
            }
        }
    }

    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        $sql = "DELETE FROM department WHERE id='$id' LIMIT 1";
        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            $_SESSION['success'] = "Department Deleted Successfully";
            header('Location:index.php');
        } else {
            $_SESSION['error'] = "Department Deletion Unsuccessful";
            header('Location:index.php');
        }
    }