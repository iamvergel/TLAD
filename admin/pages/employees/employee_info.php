<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Employee</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                                <li class="breadcrumb-item active">Employee</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title" id="EmployeeNumberTitle">Employee Information</h3>
                                <button type="button" class="btn btn-secondary float-right" id="closeEmployeeDetails" onclick="window.history.back()">
                                    BACK
                                </button>
                            </div>
                            <div class="card-body">
                                <?php
                                if (isset($_GET['EmployeeNumber'])) {
                                    $s_id = $_GET['EmployeeNumber'];

                                    $sql = "
                                        SELECT 
                                            tblemployee.*, 
                                            department.name AS department_name, 
                                            unit.unit_name AS unit_name
                                        FROM tblemployee
                                        LEFT JOIN department ON tblemployee.Department = department.id
                                        LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                                        WHERE EmployeeNumber = '$s_id'
                                    ";
                                    $query_run = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h3 class="profile-username text-center mt-5">
                                                        <?php echo $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Suffix'] . ' ' . $row['Middlename']; ?>
                                                    </h3>
                                                    <h3 class="profile-username text-center"><?php echo $row['EmployeeNumber']; ?>
                                                    </h3>
                                                    <p class="text-muted text-center mb-5">
                                                        <?php echo $row['department_name'] . ' / ' . $row['unit_name']; ?>
                                                    </p>
                                                    <ul class="list-group list-group-unbordered mb-2 px-3">
                                                        <li class="list-group-item">
                                                            <b class="float-left">Position</b>
                                                            <p class="float-right text-muted"><?php echo $row['Position']; ?></p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b class="float-left">Status</b>
                                                            <p class="float-right text-muted">
                                                                <?php
                                                                if ($row['Status'] == '1') {
                                                                    echo "Active";
                                                                } elseif ($row['Status'] == '0') {
                                                                    echo "Inactive";
                                                                } else {
                                                                    echo "Not Specified";
                                                                }
                                                                ?>
                                                            </p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b class="float-left">Birthday</b>
                                                            <p class="float-right text-muted"><?php echo $row['Birthday']; ?></p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b class="float-left">Gender</b>
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
                                                                    <a class="nav-link active" href="certificate-tab"
                                                                        data-toggle="tab" data-target="#certificate" role="tab"
                                                                        aria-controls="certificate"
                                                                        aria-selected="true">Certificate</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="remarks-tab" data-toggle="tab"
                                                                        data-target="#remarks" role="tab" aria-controls="remarks"
                                                                        aria-selected="false">Remarks</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="gallery-tab" data-toggle="tab"
                                                                        data-target="#gallery" role="tab" aria-controls="gallery"
                                                                        aria-selected="false">Gallery
                                                                        Certificate</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="card-body p-3">
                                                            <div class="tab-content" id="custom-tabs-three-tabContent">

                                                                <div class="modal fade" id="DeleteCertModal">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Delete Certificate</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close"
                                                                                    id="close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>

                                                                            <form action="employee_action.php" method="POST">
                                                                                <div class="modal-body">
                                                                                    <input type="hidden" name="delete_id"
                                                                                        id="delete_id">
                                                                                    <p> Do you want to delete this data?</p>
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary"
                                                                                        data-dismiss="modal"
                                                                                        id="close">Cancel</button>
                                                                                    <button type="submit" name="deletedata"
                                                                                        class="btn btn-danger ">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade show active" id="certificate"
                                                                    role="tabpanel" aria-labelledby="certificate-tab">

                                                                    <table id="certificatetable"
                                                                        class="table table-hover table-borderless"
                                                                        style="width:100%;">
                                                                        <thead class="bg-light">
                                                                            <tr>
                                                                                <th>Certificate</th>
                                                                                <th>Title (Date of Training)</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            if (isset($_GET['EmployeeNumber'])) {
                                                                                $employeeNumber = $_GET['EmployeeNumber'];
                                                                                $user = "SELECT * FROM tblemployeeseminar WHERE EmployeeNumber = '$employeeNumber'";
                                                                                $users_run = mysqli_query($conn, $user);

                                                                                if (mysqli_num_rows($users_run) > 0) {
                                                                                    while ($user = mysqli_fetch_assoc($users_run)) {
                                                                                        ?>
                                                                                        <tr data-id="<?= $user['id'] ?>">
                                                                                            <td style="text-align: center;" width="50%">
                                                                                                <?php
                                                                                                $fileExtension = pathinfo($user['CertificateImage'], PATHINFO_EXTENSION);
                                                                                                $filePath = "../../../upload/certificates/" . $user['CertificateImage'];

                                                                                                if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
                                                                                                    echo "<img class='gallery-lightbox' src='$filePath' class='img-thumbnail' width='200' id='showCertificate' >";
                                                                                                } elseif (strtolower($fileExtension) == 'pdf') {
                                                                                                    echo "<div class='d-flex flex-column justify-content-center align-items-center ' style='scrollbar-width: thin;'><iframe src='$filePath' width='200' style='scrollbar-width: thin;' class='gallery-lightbox' height='200' frameborder='0' id='showCertificate'></iframe>
                                                                                                        <a href='$filePath' target='_blank' class='btn btn-primary gallery-lightbox w-50 mt-2 py-1 px-0'><i class='far fa-file-pdf me-3'></i> View Certificate</a></div>";
                                                                                                } else {
                                                                                                    echo "<p>No valid file to display.</p>";
                                                                                                }
                                                                                                ?>
                                                                                            </td>

                                                                                            <!-- <td><?= $user['year']; ?></td> -->
                                                                                            <td class="w-50">
                                                                                                <textarea
                                                                                                    class="form-control title-input border-0"
                                                                                                    rows="3"
                                                                                                    data-id="<?= $user['id'] ?>"><?= htmlspecialchars($user['Title']) ?></textarea>
                                                                                            </td>
                                                                                            <td class="">
                                                                                                <div class="d-flex">
                                                                                                    <button
                                                                                                        class="btn btn-sm btn-success saveTitle"
                                                                                                        data-id="<?= $user['id'] ?>">
                                                                                                        <i class="fas fa-save"></i>
                                                                                                    </button>
                                                                                                    <button
                                                                                                        class="btn btn-sm btn-danger delete ml-1"
                                                                                                        data-id="<?= $user['id'] ?>">
                                                                                                        <i class="fas fa-trash"></i>
                                                                                                    </button>
                                                                                                </div>
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

                                                                <div class="tab-pane fade" id="remarks" role="tabpanel"
                                                                    aria-labelledby="remarks-tab">
                                                                    <table id="remarkstable"
                                                                        class="table table-hover table-borderless"
                                                                        style="width:100%;">
                                                                        <thead class="bg-light">
                                                                            <tr>
                                                                                <th class="bg-light">Year</th>
                                                                                <th class="bg-light">Remarks</th>
                                                                                <th class="bg-light">Title</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            if (isset($_GET['EmployeeNumber'])) {
                                                                                $employeeNumber = $_GET['EmployeeNumber'];
                                                                                $user_query = "SELECT * FROM tblemployeeremarks WHERE EmployeeNumber = '$employeeNumber'";
                                                                                $users_run = mysqli_query($conn, $user_query);

                                                                                if (mysqli_num_rows($users_run) > 0) {
                                                                                    foreach ($users_run as $user) {
                                                                                        $remarksYear = $user['Year'];

                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><?= $remarksYear ?></td>
                                                                                            <td>
                                                                                                <select
                                                                                                    class="form-control remark-dropdown <?= $user['Remarks'] == 1 ? 'text-success' : 'text-danger';?>" disabled
                                                                                                    data-id="<?= $user['id'] ?>"
                                                                                                    <?= $remarkDisabled ?>>
                                                                                                    <option class="text-success" value="1" <?= $user['Remarks'] == 1 ? 'selected' : '' ?>>
                                                                                                        WITH TRAINING
                                                                                                    </option>
                                                                                                    <option class="text-danger" value="0" <?= $user['Remarks'] == 0 ? 'selected' : '' ?>>
                                                                                                        WITHOUT TRAINING
                                                                                                    </option>
                                                                                                </select>
                                                                                            </td>
                                                                                            <td class="w-50">
                                                                                                <?php
                                                                                                $sql = "SELECT * FROM tblemployeeseminar WHERE EmployeeNumber = '$employeeNumber' AND year = '$remarksYear'";
                                                                                                $query_run = mysqli_query($conn, $sql);

                                                                                                if (mysqli_num_rows($query_run) > 0) {

                                                                                                    echo '<select class="form-control title-dropdown" data-id="' . $user['id'] . '">';
                                                                                                    echo '<option value="">Select Title</option>';

                                                                                                    while ($row = mysqli_fetch_array($query_run)) {
                                                                                                        $selected = ($user['Title'] == $row['Title']) ? 'selected' : '';
                                                                                                        echo '<option value="' . $row['Title'] . '" ' . $selected . '>' . $row['Title'] . '</option>';
                                                                                                    }

                                                                                                    echo '</select>';
                                                                                                } else {
                                                                                                    echo "<p>No titles found for this user in the year " . $remarksYear . ".</p>";
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <button
                                                                                                    class="btn btn-sm btn-success saveRemarks ml-1"
                                                                                                    data-id="<?= $user['id'] ?>">
                                                                                                    <i class="fas fa-save mr-1"></i> Save
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


                                                                <style>
                                                                    .gallery .gallery-item {
                                                                        overflow: hidden;
                                                                        position: relative;
                                                                        border: 3px solid #fff;
                                                                        border-radius: 8px;
                                                                        margin: 10px;
                                                                        background-color: #f0f0f0;
                                                                        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                                                                        transition: transform 0.3s ease;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        max-width: 100%;
                                                                        cursor: default;
                                                                    }

                                                                    .gallery .card-img-top {
                                                                        width: 100%;
                                                                        height: 100px;
                                                                        object-fit: cover;
                                                                        transition: all ease-in-out 0.4s;
                                                                    }

                                                                    .gallery .card-img-top:hover {
                                                                        transform: scale(1.1);
                                                                    }

                                                                    .card-body {
                                                                        padding: 0px;
                                                                    }

                                                                    .card-text {
                                                                        font-size: 1rem;
                                                                        color: #777;
                                                                    }
                                                                </style>

                                                                <div class="tab-pane fade gallery" id="gallery" role="tabpanel"
                                                                    aria-labelledby="gallery-tab">
                                                                    <div class="container-fluid"
                                                                        style="overflow-y: scroll; height: 500px; scrollbar-width: thin;">
                                                                        <div class="row no-gutters">
                                                                            <?php
                                                                            if (isset($_GET['EmployeeNumber'])) {
                                                                                $employeeNumber = $_GET['EmployeeNumber'];
                                                                                $sql = "SELECT * FROM tblemployeeseminar WHERE EmployeeNumber = '$employeeNumber' ORDER BY Date DESC";
                                                                                $query_run = mysqli_query($conn, $sql);
                                                                                $check_services = mysqli_num_rows($query_run) > 0;

                                                                                if ($check_services) {
                                                                                    while ($row = mysqli_fetch_array($query_run)) {
                                                                                        $fileExtension = pathinfo($row['CertificateImage'], PATHINFO_EXTENSION);
                                                                                        $filePath = "../../../upload/certificates/" . $row['CertificateImage'];
                                                                                        $title = $row['Title'];
                                                                                        $maxTitleLength = 30;
                                                                                        $shortenedTitle = (strlen($title) > $maxTitleLength) ? substr($title, 0, $maxTitleLength) . '...' : $title;
                                                                                        ?>
                                                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                                                                            <div class="gallery-item card border-3">
                                                                                                <p class="card-title p-2 text-center"
                                                                                                    style="font-weight: bold; font-size: 14px; margin-bottom: 0; height: 60px;"
                                                                                                    title="<?= $title ?>">
                                                                                                    <?= $shortenedTitle ?>
                                                                                                </p>
                                                                                                <div class="card-body">
                                                                                                    <?php
                                                                                                    if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
                                                                                                        echo "<a href='$filePath' class='gallery-lightbox'>
                                                                                                                <img src='$filePath' alt='Certificate' class='card-img-top'>
                                                                                                            </a>";
                                                                                                    } elseif (strtolower($fileExtension) == 'pdf') {
                                                                                                        echo "<a href='$filePath' class='btn btn-primary w-100 gallery-lightbox' target='_blank'>
                                                                                                                    <i class='far fa-file-pdf me-3'></i> View Certificate
                                                                                                                </a>";
                                                                                                    }
                                                                                                    ?>
                                                                                                </div>
                                                                                                <div class="d-flex justify-content-between">
                                                                                                    <p class="card-text px-3 py-2"
                                                                                                        style="font-weight: normal; font-size: 12px;">
                                                                                                        <?= date('F j, Y', strtotime($row['Date'])) ?>
                                                                                                    </p>
                                                                                                    <p class="card-text px-3 py-2"
                                                                                                        style="font-weight: normal; font-size: 12px;">
                                                                                                        <?= $row['year']; ?>
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php }
                                                                                } else {
                                                                                    echo "<p>No certificates found for this user.</>";
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php include('../../includes/scripts.php'); ?>
                                            <link href="https://cdn.jsdelivr.net/npm/glightbox@3.0.1/dist/css/glightbox.min.css"
                                                rel="stylesheet">
                                            <script
                                                src="https://cdn.jsdelivr.net/npm/glightbox@3.0.1/dist/js/glightbox.min.js"></script>

                                            <script>
                                                $(document).ready(function () {
                                                    const galleryLightbox = GLightbox({
                                                        selector: '.gallery-lightbox'
                                                    });

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

                                                    $(document).on('click', '.delete', function () {
                                                        var user_id = $(this).data('id');
                                                        $('#delete_id').val(user_id);
                                                        $('#DeleteCertModal').modal('show');
                                                    });

                                                    $(document).on('submit', '#DeleteCertModal form', function (e) {
                                                        e.preventDefault();

                                                        var delete_id = $('#delete_id').val();

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'employee_action.php',
                                                            data: {
                                                                delete_id: delete_id,
                                                                deletedata: true
                                                            },
                                                            success: function (response) {
                                                                if (response == 'success') {
                                                                    alert('Record deleted successfully!');
                                                                    $('#DeleteCertModal').modal('hide');

                                                                    location.reload();
                                                                } else {
                                                                    alert('Failed to delete the record. Please try again.');
                                                                }
                                                            },
                                                            error: function () {
                                                                alert('Error occurred while trying to delete. Please try again.');
                                                            }
                                                        });
                                                    });

                                                    $(document).on('click', '#close', function () {
                                                        $('#DeleteCertModal').modal('hide');
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

                                                    $('.remark-dropdown').on('change', function () {
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
                                                        var row = $(this).closest('tr');
                                                        var rowId = $(this).data('id');
                                                        var selectedTitle = row.find('.title-dropdown').val();

                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'employee_action.php',
                                                            data: {
                                                                id: rowId,
                                                                title: selectedTitle // Remark is decided in PHP
                                                            },
                                                            success: function (response) {
                                                                if (response === 'success') {
                                                                    alert('Remarks and Title updated successfully!');
                                                                    // Update remark dropdown based on title
                                                                    var remarkSelect = row.find('.remark-dropdown');
                                                                    if (selectedTitle === '') {
                                                                        remarkSelect.val('0'); // WITHOUT TRAINING
                                                                        remarkSelect.prop('disabled', true);
                                                                    } else {
                                                                        remarkSelect.val('1'); // WITH TRAINING
                                                                        remarkSelect.prop('disabled', true);
                                                                    }
                                                                } else {
                                                                    alert('Failed to update remarks or title.');
                                                                }
                                                            }
                                                        });
                                                    });
                                                });

                                                function showCertificate(imageSrc) {
                                                    window.open("../../upload/certificates/" + imageSrc);
                                                }
                                            </script>
                                            <?php
                                        }
                                    } else {
                                        echo $return = "<h5> No Record Found</h5>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('../../includes/footer.php'); ?>