<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<script>
  function loadUnitsForDepartment() {
    var departmentId = $('#department_id').val();

    if (departmentId) {
      $('#unit_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId },
        success: function (response) {
          try {
            var units = JSON.parse(response);
            var unitSelect = $('#unit_id');

            unitSelect.empty();
            unitSelect.append('<option value="">Select Unit</option>');

            if (units.length > 0) {
              units.forEach(function (unit) {
                unitSelect.append('<option value="' + unit.id + '">' + unit.unit_name + '</option>');
              });
            } else {
              unitSelect.append('<option value="">No units available</option>');
            }
          } catch (error) {
            console.error('Error parsing response:', error);
            alert('An error occurred while fetching the units.');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX request failed:', error);
          alert('An error occurred while fetching the units.');
          $('#unit_id').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#unit_id').html('<option value="">Select Unit</option>');
    }
  }

  function loadUnitsForDepartmentedit() {
    var departmentId = $('#editdepartment_id').val();

    if (departmentId) {
      $('#editunit_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId },
        success: function (response) {
          try {
            var units = JSON.parse(response);
            var unitSelect = $('#editunit_id');

            unitSelect.empty();
            unitSelect.append('<option value="">Select Unit</option>');

            if (units.length > 0) {
              units.forEach(function (unit) {
                unitSelect.append('<option value="' + unit.id + '">' + unit.unit_name + '</option>');
              });
            } else {
              unitSelect.append('<option value="">No units available</option>');
            }
          } catch (error) {
            console.error('Error parsing response:', error);
            alert('An error occurred while fetching the units.');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX request failed:', error);
          alert('An error occurred while fetching the units.');
          $('#editunit_id').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#editunit_id').html('<option value="">Select Unit</option>');
    }
  }
</script>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddAdminModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Coordinator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="coordinator_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <!-- Existing Fields -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" class="form-control" pattern="[a-zA-Z'-'\s]*" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control js-phone" name="phone" pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input id="email" type="email" name="email" pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$"
                      class="form-control" required />
                  </div>
                </div>
              </div>

              <!-- Department and Unit Dropdowns -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Department</label><span class="text-danger">*</span>
                    <select id="department_id" name="department_id" class="form-control" required
                      onchange="loadUnitsForDepartment()">
                      <option value="">Select Department</option>
                      <?php
                      include('../../config/dbconn.php');
                      $sql = "SELECT * FROM department";
                      $query_run = mysqli_query($conn, $sql);

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

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit</label><span class="text-danger">*</span>
                    <select id="unit_id" name="unit_id" class="form-control" required>
                      <option value="">Select Unit</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- New Fields for Section Head and Division -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Name</label>
                    <input type="text" name="unit_section_head_name" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Title</label>
                    <input type="text" name="unit_section_head_title" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Name</label>
                    <input type="text" name="division_head_name" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Position</label>
                    <input type="text" name="division_head_position" class="form-control" required>
                  </div>
                </div>
              </div>

              <!-- Password Fields -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="password" name="password" class="form-control"
                      pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters and one special character"
                      required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                  </div>
                </div>
              </div>

              <!-- Image Upload -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="coor_image">Upload Image</label>
                    <input type="file" name="coor_image" id="coor_image">
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_button" name="insertcoordinator" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ViewAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Admin Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="admin_viewing_data">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditAdminModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="coordinator_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" id="edit_fname" class="form-control" pattern="[a-zA-Z'-'\s]*"
                      required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" id="edit_address" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_phone" name="phone" class="form-control js-phone"
                      pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6 auto">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" name="email" id="edit_email" class="form-control email_id"
                      pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" class="form-control" required>
                    <span class="email_error text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="editdepartment_id" name="department_id">
                <input type="hidden" id="editunit_id" name="unit_id">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Department</label><span class="text-danger">*</span>
                    <select id="edit_department_id" class="form-control"  required disabled>
                      <option value="">Select Department</option>
                      <?php

                      $sql = "SELECT * FROM department";
                      $query_run = mysqli_query($conn, $sql);

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

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit</label><span class="text-danger">*</span>
                    <select id="edit_unit_id" class="form-control"  required disabled>
                      <option value="">Select Unit</option>
                      <?php
                      $sql = "SELECT * FROM unit";
                      $query_run = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No units available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- New Fields for Section Head and Division -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Name</label>
                    <input type="text" name="unit_section_head_name" id="edit_unit_section_head_name"
                      class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Title</label>
                    <input type="text" name="unit_section_head_title" id="edit_unit_section_head_title"
                      class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Name</label>
                    <input type="text" name="division_head_name" id="edit_division_head_name" class="form-control"
                      required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Position</label>
                    <input type="text" name="division_head_position" id="edit_division_head_position"
                      class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
                <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control"
                  required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="coor_image">Upload Image</label>
                    <input type="file" id="coor_image" name="coor_image" />
                    <input type="hidden" name="old_image" id="old_image" />
                    <div id="uploaded_image"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
              <button type="submit" name="updatecoordinator" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="DeleteAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="coordinator_action.php" method="POST">
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
              <h1>Coordinator</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Admin</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include('../../message.php'); ?>
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Coordinator List</h3>
                  <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#AddAdminModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Coordinator</button>
                </div>
                <div class="card-body">
                  <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Photo</th>
                        <th class="export">Name</th>
                        <th class="export">Email</th>
                        <th class="export">department</th>
                        <th class="export">unit</th>
                        <th class="export" width="5%">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "
                              SELECT 
                                tblcoordinator.*, 
                                department.name AS department_name, 
                                unit.unit_name AS unit_name
                              FROM tblcoordinator
                              LEFT JOIN department ON tblcoordinator.division_id = department.id
                              LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
                            ";

                      $query_run = mysqli_query($conn, $sql);

                      if (!$query_run) {
                        die('Query Failed: ' . mysqli_error($conn));
                      }


                      while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                        <tr>
                          <td style="text-align: center;" width="10%">
                            <img src="../../../upload/coordinators/<?= $row['image'] ?>" class="img-thumbnail img-circle"
                              width="50" alt="">
                          </td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>
                          <td>
                            <?php
                            if ($row['status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-success activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                            ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editAdminbtn">
                              <i class="fas fa-edit"></i>
                            </button>
                            <!-- <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteAdminbtn">
                              <i class="far fa-trash-alt"></i>
                            </button> -->
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th class="search">Name</th>
                        <th class="search">Address</th>
                        <th class="search">Contact No.</th>
                        <th class="search">Email</th>
                        <th class="search">Status</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('../../includes/scripts.php'); ?>
  <script>
    $(document).ready(function () {
      $('#admin_table tfoot th.search').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" class="search-input form-control form-control-sm"/>');
      });
      var table = $('#admin_table').DataTable({
        "dom": "<'row'<'col-sm-3'l><'col-sm-5'B><'col-sm-4'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "responsive": true,
        "searching": true,
        "paging": true,
        "buttons": [{
          extend: 'copyHtml5',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="fas fa-clipboard"></i>  Copy',
          exportOptions: {
            columns: '.export'
          }
        },
        {
          extend: 'csvHtml5',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="far fa-file-csv"></i>  CSV',
          exportOptions: {
            columns: '.export'
          }
        },
        {
          extend: 'excel',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="far fa-file-excel"></i>  Excel',
          exportOptions: {
            columns: '.export'
          }
        },
        {
          extend: 'pdfHtml5',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="far fa-file-pdf"></i>  PDF',
          exportOptions: {
            columns: '.export'
          }
        },
        {
          extend: 'print',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="fas fa-print"></i>  Print',
          exportOptions: {
            columns: '.export'
          }
        }
        ],
        initComplete: function () {
          // Apply the search
          this.api().columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
              if (that.search() !== this.value) {
                that
                  .search(this.value)
                  .draw();
              }
            });
          });
        }
      });

      $(document).on('click', '.viewAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'coordinator_action.php',
          type: 'post',
          data: {
            'checking_viewAdmintbtn': true,
            'user_id': userid,
          },
          success: function (response) {

            $('.admin_viewing_data').html(response);
            $('#ViewAdminModal').modal('show');
          }
        });
      });

      //Admin Delete Modal
      $(document).on('click', '.deleteAdminbtn', function () {

        var user_id = $(this).data('id');
        $('#delete_id').val(user_id);
        $('#DeleteAdminModal').modal('show');
      });

      $(document).on('click', '.activatebtn', function () {
        var userid = $(this).data('id');
        var status = $(this).data('status');
        var next_status = 'Active';
        if (status == 1) {
          next_status = 'Inactive';
        }

        if (confirm("Are you sure you want to " + next_status + " it?")) {
          $.ajax({
            type: "post",
            url: "coordinator_action.php",
            data: {
              'change_status': true,
              'user_id': userid,
              'status': status,
              'next_status': next_status
            },
            success: function (response) {
              location.reload();
            }
          });
        }
      });

      //Admin Edit Modal
      $(document).on('click', '.editAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "coordinator_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['name']);
              $('#edit_address').val(value['address']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#edit_department_id').val(value['division_id']);
              $('#edit_unit_id').val(value['unit_id']);  // Set the unit_id correctly
              $('#editdepartment_id').val(value['division_id']);
              $('#editunit_id').val(value['unit_id']);

              $('#edit_unit_section_head_name').val(value['unit_section_head_name']);
              $('#edit_unit_section_head_title').val(value['unit_section_head_title']);
              $('#edit_division_head_name').val(value['division_head_name']);
              $('#edit_division_head_position').val(value['division_head_position']);
              $('#uploaded_image').html('<img src="../../../upload/coordinators/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_confirmPassword').val(value['password']);
            });

            $('#EditAdminModal').modal('show');
          }
        });
      });

      $(document).on('click', '#close', function () {
        $('#EditAdminModal').modal('hide');
      });
    });
  </script>
  <?php include('../../includes/footer.php'); ?>