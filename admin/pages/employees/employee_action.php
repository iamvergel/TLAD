<?php
include('../../authentication.php');
include('../../config/dbconn.php');

date_default_timezone_set("Asia/Manila");

if (isset($_POST['change_status'])) {
    $id = $_POST['user_id'];
    $status = $_POST['next_status'];
    $new_status = '';

    if ($status == "Inactive") {
        $new_status = 0;
    }
    if ($status == "Active") {
        $new_status = 1;
    }

    $sql = "UPDATE tblemployee set status='$new_status' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Employee Status Change Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "Employee Status Change Unsuccessfully";
        header('Location:index.php');
    }
}

if (isset($_POST['deletedata'])) {
    $id = $_POST['delete_id'];
    $del_image = $_POST['del_image'];

    $check_img_query = " SELECT * FROM tblemployee WHERE id='$id' LIMIT 1";
    $img_res = mysqli_query($conn, $check_img_query);
    $res_data = mysqli_fetch_array($img_res);
    $image = $res_data['image'];

    $sql = "DELETE FROM tblemployee WHERE id='$id' LIMIT 1";
    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        if ($image != NULL) {
            if (file_exists('../../../upload/coordinators/' . $image)) {
                unlink("../../../upload/coordinators/" . $image);
            }
        }
        $_SESSION['success'] = "Coordinators Deleted Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = "Coordinators Deleted Unsuccessfully";
        header('Location:index.php');
    }
}

if (isset($_POST['updateadmin'])) {
    $id = $_POST['edit_id'];
    $fname = $_POST['fname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $coor_email = $_POST['email'];
    $password = $_POST['edit_password'];
    $confirmPassword = $_POST['edit_confirmPassword'];

    $old_image = $_POST['old_image'];
    $image = $_FILES['edit_coorimage']['name'];

    $checkemail = "SELECT email FROM tbladmin WHERE email='$coor_email'
        AND id != '$id'  
        UNION ALL SELECT email FROM tblstaff WHERE email='$coor_email'
        UNION ALL SELECT email FROM tblpatient WHERE email='$coor_email'
        UNION ALL SELECT email FROM tblcoortor WHERE email='$coor_email' ";
    $checkemail_run = mysqli_query($conn, $checkemail);

    if ($password == $confirmPassword) {
        if (mysqli_num_rows($checkemail_run) > 0) {
            $_SESSION['error'] = "Email Already Exist";
            header('Location:index.php');
        } else {
            $update_filename = " ";

            if ($image != NULL) {

                $allowed_file_format = array('jpg', 'png', 'jpeg');

                $image_extension = pathinfo($image, PATHINFO_EXTENSION);

                if (!in_array($image_extension, $allowed_file_format)) {
                    $_SESSION['error'] = "Upload valiid file. jpg, png";
                    header('Location:index.php');
                } else if (($_FILES["edit_coorimage"]["size"] > 5000000)) {
                    $_SESSION['error'] = "File size exceeds 5MB";
                    header('Location:index.php');
                } else {
                    $filename = time() . '.' . $image_extension;
                    $update_filename = $filename;
                }
            } else {
                $update_filename = $old_image;
            }
            if ($_SESSION['error'] == '') {
                $sql = "UPDATE tbladmin set name='$fname',address='$address', phone='$phone', email='$coor_email', password='$password', image='$update_filename' WHERE id='$id' ";
                $query_run = mysqli_query($conn, $sql);

                if ($query_run) {
                    if ($image != NULL) {
                        if (file_exists('../../../upload/admin/' . $old_image)) {
                            unlink("../../../upload/admin/" . $old_image);
                        }
                        move_uploaded_file($_FILES['edit_coorimage']['tmp_name'], '../../../upload/coordinators/' . $update_filename);
                    }
                    $_SESSION['success'] = "Admin Updated Successfully";
                    header('Location:index.php');
                } else {
                    $_SESSION['error'] = "Admin Updated Unsuccessfully";
                    header('Location:index.php');
                }
            }
        }
    } else {
        $_SESSION['error'] = "Password does not match";
        header('Location:index.php');
    }
}

if (isset($_POST['checking_editAdminbtn'])) {
    $s_id = $_POST['user_id'];
    $result_array = [];

    $sql = "SELECT * FROM tblemployee WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['checking_viewAdmintbtn'])) {
    $s_id = $_POST['user_id'];

    $sql = "SELECT * FROM tbladmin WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
            <div class="text-center">
                <img src="../../../upload/admin/<?= $row['image'] ?>" class="img-thumbnail img-fluid img-circle" width="120"
                    alt="Admin Image">
            </div>
            <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>
            <p class="text-muted text-center"><?php echo $row['specialty']; ?></p>
            <ul class="list-group list-group-unbordered mb-2">
                <li class="list-group-item">
                    <b>Email</b>
                    <p class="float-right text-muted"><?php echo $row['email']; ?></p>
                </li>
                <li class="list-group-item">
                    <b>Phone</b>
                    <p class="float-right text-muted"><?php echo $row['phone']; ?></p>
                </li>
                <li class="list-group-item">
                    <b>Address</b>
                    <p class="float-right text-muted"><?php echo $row['address']; ?></p>
                </li>
            </ul>
            <?php
        }
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['insertEmployee'])) {
    // Get form values
    $EmployeeNumber = $_POST['EmployeeNumber'];
    $Lastname = $_POST['Lastname'];
    $Firstname = $_POST['Firstname'];
    $Middlename = $_POST['Middlename'];
    $Suffix = $_POST['Suffix'];
    $Birthday = $_POST['Birthday'];
    $ContactNumber = $_POST['ContactNumber'];
    $Sex = $_POST['Sex'];
    $Position = $_POST['Position'];
    $Department = $_POST['Department'];
    $UnitSection = $_POST['UnitSection'];
    // Automatically set Status to 1
    $Status = 1;
    $coordinator_id = $_POST['coordinator_id'];

    // Insert into the tblemployee table
    $regdate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tblemployee (EmployeeNumber, Lastname, Firstname, Middlename, Suffix, Birthday, ContactNumber, Sex, Position, Department, UnitSection, Status, coordinator_id, created_at)
            VALUES ('$EmployeeNumber', '$Lastname', '$Firstname', '$Middlename', '$Suffix', '$Birthday', '$ContactNumber', '$Sex', '$Position', '$Department', '$UnitSection', '$Status', '$coordinator_id', '$regdate')";

    $query_run = mysqli_query($conn, $sql);

    if ($query_run) {
        $_SESSION['success'] = "Employee Added Successfully";
        header('Location:index.php');
    } else {
        $_SESSION['error'] = mysqli_error($conn);
        header('Location:index.php');
    }
}