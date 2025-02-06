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

// if (isset($_POST['deletedata'])) {
//     $id = $_POST['delete_id'];
//     $del_image = $_POST['del_image'];

//     $check_img_query = " SELECT * FROM tblemployee WHERE id='$id' LIMIT 1";
//     $img_res = mysqli_query($conn, $check_img_query);
//     $res_data = mysqli_fetch_array($img_res);
//     $image = $res_data['image'];

//     $sql = "DELETE FROM tblemployee WHERE id='$id' LIMIT 1";
//     $query_run = mysqli_query($conn, $sql);

//     if ($query_run) {
//         if ($image != NULL) {
//             if (file_exists('../../../upload/coordinators/' . $image)) {
//                 unlink("../../../upload/coordinators/" . $image);
//             }
//         }
//         $_SESSION['success'] = "Coordinators Deleted Successfully";
//         header('Location:index.php');
//     } else {
//         $_SESSION['error'] = "Coordinators Deleted Unsuccessfully";
//         header('Location:index.php');
//     }
// }

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

    $sql = "
                                  SELECT 
                                    tblemployee.*, 
                                    department.name AS department_name, 
                                    unit.unit_name AS unit_name
                                  FROM tblemployee
                                  LEFT JOIN department ON tblemployee.Department = department.id
                                  LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                                  WHERE EmployeeNumber ='$s_id';
                                ";
    $query_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            ?>
            <div class="row">
                <div class="col-md-3">
                    <h3 class="profile-username text-center">
                        <?php echo $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Suffix'] . ' ' . $row['Middlename']; ?>
                    </h3>
                    <h3 class="profile-username text-center"><?php echo $row['EmployeeNumber']; ?></h3>
                    <p class="text-muted text-center"><?php echo $row['department_name'] . ' / ' . $row['unit_name']; ?></p>
                    <ul class="list-group list-group-unbordered mb-2">
                        <li class="list-group-item">
                            <b>Position</b>
                            <p class="float-right text-muted"><?php echo $row['Position']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b>
                            <p class="float-right text-muted">
                                <?php
                                if ($row['Status'] == '1') {
                                    echo "Active";
                                } elseif ($row['Sex'] == '0') {
                                    echo "Inactive";
                                } else {
                                    echo "Not Specified";
                                }
                                ?>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <b>Birthday</b>
                            <p class="float-right text-muted"><?php echo $row['Birthday']; ?></p>
                        </li>
                        <li class="list-group-item">
                            <b>Gender</b>
                            <p class="float-right text-muted">
                                <?php
                                if ($row['Sex'] == 'F') {
                                    echo "Female";
                                } elseif ($row['Sex'] == 'M') {
                                    echo "Male";
                                } else {
                                    echo "Not Specified";
                                }
                                ?>
                            </p>
                        </li>
                    </ul>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="certificate-tab" data-toggle="tab" data-target="#certificate"
                                        role="tab" aria-controls="certificate" aria-selected="true">Certificate</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="remarks-tab" data-toggle="tab" data-target="#remarks" role="tab"
                                        aria-controls="remarks" aria-selected="false">Remarks</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade show active" id="certificate" role="tabpanel"
                                    aria-labelledby="certificate-tab">

                                    <!-- Certificate-->
                                    <table id="certificatetable" class="table table-hover table-borderless" style="width:100%;">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Date Uploaded</th>
                                                <th>Certificate</th>
                                                <th>Title (Date of Training)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['user_id'])) {
                                                $employeeNumber = $_POST['user_id'];
                                                $user = "SELECT * FROM tblemployeeseminar WHERE EmployeeNumber = '$employeeNumber'";
                                                $users_run = mysqli_query($conn, $user);

                                                if (mysqli_num_rows($users_run) > 0) {
                                                    foreach ($users_run as $user) {
                                                        ?>
                                                        <tr>
                                                            <td><?= date('d-M-Y', strtotime($user['Date'])) ?></td>
                                                            <td style="text-align: center;" width="10%">
                                                                <img src="../../../upload/certificates/<?= $user['CertificateImage'] ?>"
                                                                    class="img-thumbnail" width="200" alt="No Image Available"
                                                                    id="showCertificate"
                                                                    onclick="showCertificate('<?= $user['CertificateImage'] ?>')">
                                                            </td>
                                                            <td class="w-50">
                                                                <textarea class="form-control title-input border-0" rows="3"
                                                                    data-id="<?= $user['id'] ?>"><?= htmlspecialchars($user['Title']) ?></textarea>
                                                            </td>

                                                            <td>
                                                                <button class="btn btn-sm btn-success saveTitle" data-id="<?= $user['id'] ?>">
                                                                    <i class="fas fa-save"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='3'>No Data Found</td></tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                                    <table id="remarkstable" class="table table-hover table-borderless" style="width:100%;">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="bg-light">Year</th>
                                                <th class="bg-light">Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['user_id'])) {
                                                $employeeNumber = $_POST['user_id'];
                                                $user = "SELECT * FROM tblemployeeremarks WHERE EmployeeNumber = '$employeeNumber'";
                                                $users_run = mysqli_query($conn, $user);

                                                if (mysqli_num_rows($users_run) > 0) {
                                                    foreach ($users_run as $user) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $user['Year'] ?></td>
                                                            <td class="w-75">
                                                                <select class="form-control remark-dropdown 
                                                                    <?php echo $user['Remarks'] == 1 ? 'text-success' : ($user['Remarks'] == 0 ? 'text-danger' : ''); ?>"
                                                                    data-id="<?= $user['id'] ?>">
                                                                    <option class="text-success" value="1" <?= $user['Remarks'] == 1 ? 'selected' : '' ?>>
                                                                        WITH TRAINING
                                                                    </option>
                                                                    <option class="text-danger" value="0" <?= $user['Remarks'] == 0 ? 'selected' : '' ?>>
                                                                        WITHOUT TRAINING
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-success saveRemarks ml-1"
                                                                    data-id="<?= $user['id'] ?>">
                                                                    <i class="fas fa-save"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {

                    var table1 = $('#certificatetable').DataTable({
                        responsive: true,
                        searching: true,
                        paging: true,
                        info: true,
                        pageLength: 5,
                    });
                    var table2 = $('#remarkstable').DataTable({
                        responsive: true,
                        searching: true,
                        paging: true,
                        info: true,
                        pageLength: 5,
                    });

                    $('.nav-pills a').on('shown.bs.tab', function (event) {
                        var tabID = $(event.target).attr('data-target');
                        if (tabID === '#appointment') {
                            table1.columns.adjust().responsive.recalc();
                        }
                        if (tabID === '#remarkstable') {
                            table2.columns.adjust().responsive.recalc();
                        }
                    });

                    $('.remark-dropdown').on('change', function() {
                        var selectedValue = $(this).val();  
                        var $select = $(this);  

                        if (selectedValue == '1') {
                            $select.removeClass('text-danger').addClass('text-success');
                        } else if (selectedValue == '0') {
                            $select.removeClass('text-success').addClass('text-danger');
                        } else {
                            $select.removeClass('text-success text-danger');
                        }
                    });

                    $('.saveTitle').on('click', function () {
                        var rowId = $(this).data('id');
                        var newTitle = $(this).closest('tr').find('.title-input').val();

                        $.ajax({
                            type: 'POST',
                            url: 'employee_action.php',
                            data: {
                                certificateId: rowId,
                                newTitle: newTitle
                            },
                            success: function (response) {
                                if (response === 'success') {
                                    alert('Title updated successfully!');
                                } else {
                                    alert('Failed to update title.');
                                }
                            }
                        });
                    });

                    $('.saveRemarks').on('click', function () {
                        var rowId = $(this).data('id');
                        var selectedRemark = $(this).closest('tr').find('.remark-dropdown').val();

                        $.ajax({
                            type: 'POST',
                            url: 'employee_action.php',
                            data: {
                                id: rowId,
                                remark: selectedRemark
                            },
                            success: function (response) {
                                if (response === 'success') {
                                    alert('Remarks updated successfully!');
                                } else {
                                    alert('Failed to update remarks.');
                                }
                            }
                        });
                    });
                });

                function showCertificate(imageSrc) {
                    window.open("../../../upload/certificates/" + imageSrc);
                }
            </script>
            <?php
        }
    } else {
        echo $return = "<h5> No Record Found</h5>";
    }
}

if (isset($_POST['addYear'])) {
    $year = $_POST['Year'];

    if (!empty($year)) {
        // Check if the year already exists for any employee globally
        $checkQuery = "SELECT * FROM tblemployeeremarks WHERE Year = ?";
        if ($stmt = mysqli_prepare($conn, $checkQuery)) {
            mysqli_stmt_bind_param($stmt, 's', $year);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // If the year already exists for any employee, show an error message
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('Year $year already exists in the system for some employees.');
                        window.location.href = 'index.php';
                </script>";
            } else {
                // Fetch all EmployeeNumbers from tblemployee
                $getAllEmployeesQuery = "SELECT EmployeeNumber FROM tblemployee";
                $employees_result = mysqli_query($conn, $getAllEmployeesQuery);

                if ($employees_result) {
                    while ($employee = mysqli_fetch_assoc($employees_result)) {
                        // For each employee, insert the year into tblemployeeremarks if it doesn't already exist
                        $employeeNumber = $employee['EmployeeNumber'];

                        // Check if the year already exists for the employee
                        $checkExistingQuery = "SELECT * FROM tblemployeeremarks WHERE EmployeeNumber = ? AND Year = ?";
                        if ($checkStmt = mysqli_prepare($conn, $checkExistingQuery)) {
                            mysqli_stmt_bind_param($checkStmt, 'ss', $employeeNumber, $year);
                            mysqli_stmt_execute($checkStmt);
                            $existingResult = mysqli_stmt_get_result($checkStmt);

                            // If the year does not exist for the employee, insert it
                            if (mysqli_num_rows($existingResult) === 0) {
                                $insertQuery = "INSERT INTO tblemployeeremarks (EmployeeNumber, Year) VALUES (?, ?)";
                                if ($insertStmt = mysqli_prepare($conn, $insertQuery)) {
                                    mysqli_stmt_bind_param($insertStmt, 'ss', $employeeNumber, $year);
                                    mysqli_stmt_execute($insertStmt);
                                }
                            }
                        }
                    }

                    echo "<script>alert('Year $year added for all employees!');
                            window.location.href = 'index.php';
                    </script>";
                } else {
                    echo "Error: Unable to fetch employees.";
                }
            }
        }
    } else {
        echo "Please fill out the year field.";
    }
}

if (isset($_POST['certificateId']) && isset($_POST['newTitle'])) {
    $certificateId = $_POST['certificateId'];
    $newTitle = $_POST['newTitle'];

    $query = "UPDATE tblemployeeseminar SET Title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'si', $newTitle, $certificateId);

    if (mysqli_stmt_execute($stmt)) {
        echo 'success';
    } else {
        echo 'failure';
    }

    mysqli_stmt_close($stmt);
}

if (isset($_POST['id']) && isset($_POST['remark'])) {
    $id = $_POST['id'];
    $remark = $_POST['remark'];

    $query = "UPDATE tblemployeeremarks SET Remarks = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $remark, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo 'success';
    } else {
        echo 'failure';
    }

    mysqli_stmt_close($stmt);
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

if (isset($_POST['uploadCertificate'])) {
    $employeeNumber = $_POST['EmployeeNumber'];
    $certificateImage = $_FILES['CertificateImage']['name'];
    $uploadDate = date('Y-m-d H:i:s');
    $Title = $_POST['Title'];

    // Check if the image was uploaded
    if ($certificateImage != NULL) {
        $allowed_file_format = array('jpg', 'png', 'jpeg');
        $image_extension = pathinfo($certificateImage, PATHINFO_EXTENSION);

        if (!in_array($image_extension, $allowed_file_format)) {
            $_SESSION['error'] = "Upload valid file. jpg, png";
            header('Location:index.php');
        } else if ($_FILES['CertificateImage']['size'] > 5000000) {
            $_SESSION['error'] = "File size exceeds 5MB";
            header('Location:index.php');
        } else {
            // Move uploaded image to the directory
            $filename = time() . '.' . $image_extension;
            move_uploaded_file($_FILES['CertificateImage']['tmp_name'], '../../../upload/certificates/' . $filename);
        }
    }

    if ($_SESSION['error'] == '') {
        // Insert certificate data into the database
        $sql = "INSERT INTO tblemployeeseminar (EmployeeNumber, Date, CertificateImage, Title)
                VALUES ('$employeeNumber', '$uploadDate', '$filename', '$Title')";
        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
            $_SESSION['success'] = "Certificate Uploaded Successfully";
            header('Location:index.php');
        } else {
            $_SESSION['error'] = mysqli_error($conn);
            header('Location:index.php');
        }
    }
}