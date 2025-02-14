<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="modal fade" id="AddUnitModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="unit_action.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Department</label><span class="text-danger">*</span>
                                        <select name="department_id" class="form-control" required>
                                            <option value="">Select Department</option>
                                            <?php
                                            // Fetch all departments from the database
                                            include('../../config/dbconn.php');
                                            $sql = "SELECT * FROM department";
                                            $query_run = mysqli_query($conn, $sql);

                                            // Check if there are departments in the database
                                            if (mysqli_num_rows($query_run) > 0) {
                                                while ($row = mysqli_fetch_assoc($query_run)) {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value=''>No departments available</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label><span class="text-danger">*</span>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="insert_unit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="EditUnitModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="unit_action.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Department</label><span class="text-danger">*</span>
                                        <select name="department_id" id="edit_department_id" class="form-control"
                                            required>
                                            <option value="">Select Department</option>
                                            <?php
                                            // Fetch departments from the database
                                            $sql = "SELECT * FROM department";
                                            $query_run = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="hidden" id="edit_id" name="edit_id">
                                    <div class="form-group">
                                        <label>Unit Name</label><span class="text-danger">*</span>
                                        <input type="text" name="unit_name" id="edit_unit_name" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                            <button type="submit" name="update_unit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="DeleteUnitModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="unit_action.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" id="delete_id">
                            <p> Do you want to delete this data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="deletedata" class="btn btn-success ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Unit</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Unit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success mx-2">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger mx-2">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include('../../message.php'); ?>
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Units</h3>
                                    <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                                        data-target="#AddUnitModal">
                                        <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Unit</button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-borderless table-hover" style="width:100%;">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Unit ID</th>
                                                <th>Department Name</th>
                                                <th>Name</th>
                                                <th width="50">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT unit.id, unit.unit_name, department.name AS department_name 
                                            FROM unit
                                            JOIN department ON unit.department_id = department.id";
                                            $query_run = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_array($query_run)) {
                                                ?>
                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['department_name'] ?></td>
                                                    <td><?= $row['unit_name'] ?></td>
                                                    <td class="d-flex">
                                                        <!-- Make sure the class is 'editUnitbtn' as referenced in JavaScript -->
                                                        <button data-id="<?= $row['id'] ?>"
                                                            class="btn btn-sm btn-info editUnitbtn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button data-id="<?= $row['id'] ?>"
                                                            class="btn btn-danger btn-sm deleteUnitModal ml-1">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div> <!-- /.container -->
        </div> <!-- /.content-wrapper -->
    </div>

    <?php include('../../includes/scripts.php'); ?>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.editUnitbtn', function () {
                var unitId = $(this).data('id');  // Get unit ID

                $.ajax({
                    type: "POST",
                    url: "unit_action.php",
                    data: {
                        'checking_unit': true,
                        'unit_id': unitId,  // Send unit ID to fetch data
                    },
                    success: function (response) {
                        try {
                            // Try parsing the response (in case it's not automatically parsed)
                            var data = JSON.parse(response);

                            // Check if the response is an array and has at least one item
                            if (Array.isArray(data) && data.length > 0) {
                                var value = data[0];  // Get the first unit data object

                                // Populate the modal form with the unit data
                                $('#edit_id').val(value['id']);
                                $('#edit_department_id').val(value['department_id']);
                                $('#edit_unit_name').val(value['unit_name']);

                                // Show the modal
                                $('#EditUnitModal').modal('show');
                            } else {
                                console.error("Invalid response format or no data:", data);
                                alert("Error: Unable to fetch unit data.");
                            }
                        } catch (error) {
                            console.error("Error parsing response:", error);
                            alert("Error: Unable to process the data.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", error);
                        alert("An error occurred while fetching data.");
                    }
                });
            });

            $(document).on('click', '#close', function () {
                $('#EditUnitModal').modal('hide');
            });

            $(document).on('click', '.deleteUnitModal', function () {
                var unitId = $(this).data('id');  // Get unit ID
                $('#delete_id').val(unitId);  // Set the delete ID
                $('#DeleteUnitModal').modal('show');
            });
        });
    </script>
    <?php include('../../includes/footer.php'); ?>