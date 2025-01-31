<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddEmployeesModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Employees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="Employees_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
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
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="doc_image">Upload Image</label>
                    <input type="file" name="doc_image" id="doc_image">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_button" name="insertEmployees" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ViewEmployeesModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Employees Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="Employees_viewing_data">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditEmployeesModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Employees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="Employees_action.php" method="POST" enctype="multipart/form-data">
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
                <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
                <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control"
                  required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="doc_image">Upload Image</label>
                    <input type="file" id="edit_docimage" name="edit_docimage" />
                    <input type="hidden" name="old_image" id="old_image" />
                    <div id="uploaded_image"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="updateEmployees" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="DeleteEmployeesModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Employees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="Employees_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <p> Do you want to delete this data?</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="deletedata" class="btn btn-primary ">Submit</button>
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
              <h1>Employees</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Employees</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include('message.php'); ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Employees List</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                    data-target="#AddEmployeesModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Employees</button>
                </div>
                <div class="card-body">
                  <table id="employee_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Employee Number</th>
                        <th class="export">Name</th>
                        <th class="export">Contact No.</th>
                        <th class="export">Sex</th>
                        <th class="export">Position</th>
                        <th class="export">Department</th>
                        <th class="export">Unit</th>
                        <th class="export" width="5%">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody><?php
                    $i = 1;
                    $user = $_SESSION['auth_user']['user_id'];
                    $sql = "SELECT 
                                tblemployee.*, 
                                department.name AS department_name, 
                                unit.unit_name AS unit_name
                            FROM tblemployee
                            LEFT JOIN department ON tblemployee.Department = department.id
                            LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                            WHERE tblemployee.coordinator_id = $user";

                    $query_run = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($query_run)) { ?>
                        <tr>
                          <!-- <td style="text-align: center;" width="10%"><img src="../../../upload/Employees/<?= $row['image'] ?>" class="img-thumbnail img-circle" width="50" alt=""></td> -->
                          <td><?php echo $row['EmployeeNumber']; ?></td>
                          <td>
                            <?php echo $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Suffix']; ?>
                          </td>
                          <td><?php echo $row['ContactNumber']; ?></td>
                          <td><?php echo $row['Sex']; ?></td>
                          <td><?php echo $row['Position']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>

                          <td>
                            <?php
                            if ($row['Status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-success activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                            ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editEmployeesbtn"><i
                                class="fas fa-edit"></i></button>
                            <!-- <input type="hidden" name="del_image" value="<?php echo $row['image']; ?>"> -->
                            <button data-id="<?php echo $row['id']; ?>"
                              class="btn btn-danger btn-sm deleteEmployeesbtn"><i class="far fa-trash-alt"></i></button>
                          </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="search">Employee Number</th>
                        <th class="search">Name</th>
                        <th class="search">Contact No.</th>
                        <th class="search">Sex</th>
                        <th class="search">Position</th>
                        <th class="search">Department</th>
                        <th class="search">Unit</th>
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
  <?php include('includes/scripts.php'); ?>
  <script>
    $(document).ready(function () {
      $('#employee_table tfoot th.search').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" class="search-input form-control form-control-sm"/>');
      });
      var table = $('#employee_table').DataTable({
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

      $(document).on('click', '.viewEmployeesbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'Employees_action.php',
          type: 'post',
          data: {
            'checking_viewEmployeestbtn': true,
            'user_id': userid,
          },
          success: function (response) {

            $('.Employees_viewing_data').html(response);
            $('#ViewEmployeesModal').modal('show');
          }
        });
      });

      //Employees Edit Modal
      $(document).on('click', '.editEmployeesbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "Employees_action.php",
          data: {
            'checking_editEmployeesbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['name']);
              $('#edit_address').val(value['address']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#uploaded_image').html('<img src="../../../upload/Employees/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_confirmPassword').val(value['password']);
            });

            $('#EditEmployeesModal').modal('show');
          }
        });
      });
      //Employees Delete Modal
      $(document).on('click', '.deleteEmployeesbtn', function () {

        var user_id = $(this).data('id');
        $('#delete_id').val(user_id);
        $('#DeleteEmployeesModal').modal('show');
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
            url: "Employees_action.php",
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


    });
  </script>

  <?php include('includes/footer.php'); ?>