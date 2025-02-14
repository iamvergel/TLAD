<?php
include('../../authentication.php');
include('../../config/dbconn.php');

if (isset($_POST['system_details'])) {
    $name = $_POST['name'];
    $day = $_POST['day'];
    $opening_hours = $_POST['opening_hours'];
    $closing_hours = $_POST['closing_hours'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $facebook = $_POST['fblink'];
    $map = $_POST['map'];
    $days = implode(',', $day);

    $old_image = $_POST['old_image'];
    $image = $_FILES['img_url']['name'];

    $old_image_brand = $_POST['old_image_brand'];
    $image_brand = $_FILES['img_brand']['name'];

    $old_image_logo1 = $_POST['old_image_logo1'];
    $image_logo1 = $_FILES['logo1']['name'];

    $old_image_logo2 = $_POST['old_image_logo2'];
    $image_logo2 = $_FILES['logo2']['name'];

    $update_filename = "";
    if ($image != null) {
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:index.php');
        } else if (($_FILES['img_url']['size'] > 5000000)) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:index.php');
        } else {
            $filename = time() . '.' . $image_extension;
            $update_filename = $filename;
        }
    } else {
        $update_filename = $old_image;
    }

    $update_brandname = "";
    if ($image_brand != null) {
        $image_extension = pathinfo($image_brand, PATHINFO_EXTENSION);
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:index.php');
        } else if (($_FILES['img_brand']['size'] > 5000000)) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:index.php');
        } else {
            $filename = time() . '.' . $image_extension;
            $update_brandname = $filename;
        }
    } else {
        $update_brandname = $old_image_brand;
    }

    $update_logo1 = "";
    if ($image_logo1 != null) {
        $image_extension = pathinfo($image_logo1, PATHINFO_EXTENSION);
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:index.php');
        } else if (($_FILES['logo1']['size'] > 5000000)) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:index.php');
        } else {
            $filename = time() . '.' . $image_extension;
            $update_logo1 = $filename;
        }
    } else {
        $update_logo1 = $old_image_logo1;
    }

    $update_logo2 = "";
    if ($image_logo2 != null) {
        $image_extension = pathinfo($image_logo2, PATHINFO_EXTENSION);
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:index.php');
        } else if (($_FILES['logo2']['size'] > 5000000)) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:index.php');
        } else {
            $filename = time() . '.' . $image_extension;
            $update_logo2 = $filename;
        }
    } else {
        $update_logo2 = $old_image_logo2;
    }

    if ($_SESSION['error'] == '') {
        $sql = "UPDATE system_details SET name='$name',days='$days',openhr='$opening_hours',closehr='$closing_hours',address='$address',telno='$telephone',email='$email',mobile='$mobile',facebook='$facebook',map='$map',logo='$update_filename',brand='$update_brandname',logo1='$update_logo1',logo2='$update_logo2' WHERE id='1'";
        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            if ($image != NULL) {
                if (file_exists('../../../upload/' . $old_image)) {
                    unlink("../../../upload/" . $old_image);
                }
                move_uploaded_file($_FILES['img_url']['tmp_name'], '../../../upload/' . $update_filename);
            }
            if ($image_brand != NULL) {
                if (file_exists('../../../upload/' . $old_image_brand)) {
                    unlink("../../../upload/" . $old_image_brand);
                }
                move_uploaded_file($_FILES['img_brand']['tmp_name'], '../../../upload/' . $update_brandname);
            }
            if ($image_logo1 != NULL) {
                if (file_exists('../../../upload/' . $old_image_logo1)) {
                    unlink("../../../upload/" . $old_image_logo1);
                }
                move_uploaded_file($_FILES['logo1']['tmp_name'], '../../../upload/' . $update_logo1);
            }
            if ($image_logo2 != NULL) {
                if (file_exists('../../../upload/' . $old_image_logo2)) {
                    unlink("../../../upload/" . $old_image_logo2);
                }
                move_uploaded_file($_FILES['logo2']['tmp_name'], '../../../upload/' . $update_logo2);
            }

            $_SESSION['success'] = "Settings Updated Successfully";
            header('Location: index.php');
        } else {
            $_SESSION['error'] = "Settings Update Failed";
            header('Location: index.php');
        }
    }
}