<?php
include('authentication.php');
include('../admin/config/dbconn.php');

if (isset($_POST['profile_details'])) {
    $id = $_POST['userid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $unit_section_head_name = $_POST['unit_section_head_name'];
    $unit_section_head_title = $_POST['unit_section_head_title'];
    $division_head_name = $_POST['division_head_name'];
    $division_head_position = $_POST['division_head_position'];
    $email = $_POST['email'];

    $old_image = $_POST['old_image'];
    $image = $_FILES['img_url']['name'];

    $update_filename = "";
    if ($image != null) {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:profile.php');
            exit();
        } else if (($_FILES['img_url']['size'] > 5000000)) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:profile.php');
            exit();
        } else {
            $filename = time() . '.' . $image_extension;
            $update_filename = $filename;
        }
    } else {
        $update_filename = $old_image;
    }

    if ($_SESSION['error'] == '') {
        $sql = "UPDATE tblcoordinator SET 
                    name='$name', 
                    gender='$gender', 
                    address='$address', 
                    phone='$contact', 
                    unit_section_head_name='$unit_section_head_name', 
                    unit_section_head_title='$unit_section_head_title', 
                    division_head_name='$division_head_name', 
                    division_head_position='$division_head_position', 
                    email='$email',
                    image='$update_filename'
                    WHERE id='$id'";

        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            if ($image != NULL) {
                if (file_exists('../upload/coordinators/' . $old_image)) {
                    unlink("../upload/coordinators/" . $old_image);
                }
                move_uploaded_file($_FILES['img_url']['tmp_name'], '../upload/coordinators/' . $update_filename);
            }

            $_SESSION['success'] = "Profile Updated Successfully";
            header('Location: profile.php');
        } else {
            $_SESSION['error'] = "Profile Update Failed";
            header('Location: profile.php');
        }
    }
}


if (isset($_POST['change_password'])) {
    $id = $_POST['userid'];
    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (!empty($current_pass) && !empty($new_pass) && !empty($confirm_pass)) {
        $sql = "SELECT password FROM tblcoordinator WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($current_pass, $row['password'])) {
                    if ($new_pass == $confirm_pass) {
                        $hash = password_hash($new_pass, PASSWORD_DEFAULT);
                        $update_password = "UPDATE tblcoordinator SET password='$hash' WHERE id='$id' LIMIT 1";
                        $update_password_run = mysqli_query($conn, $update_password);

                        if ($update_password_run) {
                            $_SESSION['success'] = "Password has been changed";
                            header("Location:profile.php");
                        }
                    } else {
                        $_SESSION['error'] = "Password and Confirm Password does not match";
                        header("Location:profile.php");
                    }

                } else {
                    $_SESSION['error'] = "Your current password does not match. Please try again.";
                    header("Location:profile.php");
                }
            }
        }

    } else {
        $_SESSION['error'] = "Please Complete All Fields";
        header("Location:profile.php");
    }
}
?>