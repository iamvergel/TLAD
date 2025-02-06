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

  function filterTable() {
    var departmentId = document.getElementById("department_id").value;
    var unitId = document.getElementById("unit_id").value;

    // Make an AJAX request to filter data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "filter_admin_data.php?department_id=" + departmentId + "&unit_id=" + unitId, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Update the table with filtered data
        document.querySelector('#employee_table tbody').innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  }

  function addloadUnitsForDepartment() {
    var departmentId1 = $('#department_id1').val();

    if (departmentId1) {
      $('#unitSection').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId1 },
        success: function (response) {
          try {
            var units1 = JSON.parse(response);
            var unitSelect1 = $('#unitSection');

            unitSelect1.empty();
            unitSelect1.append('<option value="">Select Unit</option>');

            if (units1.length > 0) {
              units1.forEach(function (unit) {
                unitSelect1.append('<option value="' + unit.id + '">' + unit.unit_name + '</option>');
              });
            } else {
              unitSelect1.append('<option value="">No units available</option>');
            }
          } catch (error) {
            console.error('Error parsing response:', error);
            alert('An error occurred while fetching the units.');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX request failed:', error);
          alert('An error occurred while fetching the units.');
          $('#unitSection').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#unitSection').html('<option value="">Select Unit</option>');
    }
  }

  function loadCoordinator() {
    var unitId = $('#unitSection').val();

    if (unitId) {
      $('#coordinator_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_coordinator.php',
        type: 'GET',
        data: { unit_id: unitId },
        success: function (response) {
          try {
            var coordinators = JSON.parse(response);
            var coordinatorSelect = $('#coordinator_id');

            coordinatorSelect.empty();
            coordinatorSelect.append('<option value="">Select Coordinator</option>');

            if (coordinators.length > 0) {
              coordinators.forEach(function (coordinator) {
                coordinatorSelect.append('<option value="' + coordinator.id + '">' + coordinator.name + '</option>');
              });
            } else {
              coordinatorSelect.append('<option value="">No coordinators available</option>');
            }
          } catch (error) {
            console.error('Error parsing response:', error);
            alert('An error occurred while fetching the coordinators.');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX request failed:', error);
          alert('An error occurred while fetching the coordinators.');
          $('#coordinator_id').html('<option value="">Select Coordinator</option>');
        }
      });
    } else {
      $('#coordinator_id').html('<option value="">Select Coordinator</option>');
    }
  }
</script>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddEmployeeModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="employee_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Employee Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="EmployeeNumber" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Lastname</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Lastname" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Firstname</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Firstname" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Middlename</label>
                    <input type="text" name="Middlename" class="form-control">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Suffix</label>
                    <input type="text" name="Suffix" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Birthday</label>
                    <span class="text-danger">*</span>
                    <input type="date" name="Birthday" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="ContactNumber" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Sex</label>
                    <span class="text-danger">*</span>
                    <select name="Sex" class="form-control" required>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Position</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Position" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Department</label>
                    <span class="text-danger">*</span>
                    <select id="department_id1" name="Department" class="form-control" required
                      onchange="addloadUnitsForDepartment()">
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
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit/Section</label>
                    <span class="text-danger">*</span>
                    <select id="unitSection" name="UnitSection" class="form-control" onchange="loadCoordinator()"
                      required>
                      <option value="">Select Unit</option>
                      <!-- Units will be dynamically loaded here -->
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Coordinator</label>
                <select id="coordinator_id" name="coordinator_id" class="form-control" required>
                  <option value="">Select Coordinator</option>
                  <!-- Coordinators will be dynamically loaded here -->
                </select>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="insertEmployee" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewEmployeeModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="EmployeeNumberTitle"></h5>
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
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin_action.php" method="POST" enctype="multipart/form-data">
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
              <button type="submit" name="updateadmin" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal for Uploading Certificate -->
    <div class="modal fade" id="uploadCertificateModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Upload Certificate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="employee_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label>Employee Number</label>
                <span class="text-danger">*</span>
                <input type="text" name="EmployeeNumber" id="employeeNumber" class="form-control" required readonly>
              </div>
              <div class="form-group">
                <label>Certificate Image</label>
                <span class="text-danger">*</span>
                <input type="file" name="CertificateImage" id="CertificateImage" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Certificate Title (Date of Traing)</label>
                <span class="text-danger">*</span>
                <p class="text-muted">(Ex. ExampleCertificate (January 01, 2025))</p>
                <input type="text" name="Title" id="Title" class="form-control" required>
              </div>
              <!-- <div class="form-group">
                <label for="Remarks">Remarks:</label>
                <textarea name="Remarks" id="Remarks" class="form-control" rows="3"></textarea>
              </div> -->
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="uploadCertificate" class="btn btn-primary">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addYearModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Training Year of Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="employee_action.php" method="POST" enctype="multipart/form-data">
            <div class="form-group col-md-12 my-3">
              <label>Add Year</label>
              <span class="text-danger">*</span>
              <div class="d-flex">
                <input type="text" name="Year" id="year" class="form-control ml-1" required>
                <button type="submit" name="addYear" class="btn btn-sm btn-primary addYear ml-1">
                  <i class="fas fa-calendar"></i>
                </button>
              </div>
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
              <h1>Admin</h1>
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
          <?php include('../../message.php'); ?>
          <div class="row">
            <div class="col-sm-2">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">SELECT DEPARTMENT AND UNIT</h3>
                </div>
                <div class="row px-3 py-2">
                  <div class="col-md-12 mt-2">
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

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Unit</label><span class="text-danger">*</span>
                      <select id="unit_id" name="unit_id" class="form-control" required>
                        <option value="">Select Unit</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-12 mt-5">
                    <button class="btn btn-md btn-success w-100" onclick="filterTable()">Search</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-10">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Admin List</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right ml-2" data-toggle="modal"
                    data-target="#AddEmployeeModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Employee</button>

                  <button type="button" class="btn btn-success btn-sm float-right me-2" data-toggle="modal"
                    data-target="#addYearModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Year</button>
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
                        <th style="width: 100px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $user = $_SESSION['auth_user']['user_id'];
                      $sql = "
                                  SELECT 
                                    tblemployee.*, 
                                    department.name AS department_name, 
                                    unit.unit_name AS unit_name
                                  FROM tblemployee
                                  LEFT JOIN department ON tblemployee.Department = department.id
                                  LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                                  WHERE tblemployee.Status = 1;
                                ";

                      $query_run = mysqli_query($conn, $sql);

                      if (!$query_run) {
                        die('Query Failed: ' . mysqli_error($conn));
                      }


                      while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                        <tr>
                          <td><?php echo $row['EmployeeNumber']; ?></td>
                          <td>
                            <?php echo $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Suffix'] . ' ' . $row['Middlename']; ?>
                          </td>
                          <td><?php echo $row['ContactNumber']; ?></td>
                          <td><?php echo $row['Sex']; ?></td>
                          <td><?php echo $row['Position']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>

                          <td><?php
                          if ($row['id'] == $user) {
                          } else {
                            if ($row['Status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-success activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                          }
                          ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editEmployeebtn"><i
                                class="fas fa-edit me-2"></i></button>
                            <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-secondary viewEmployeebtn"><i class="fas fa-eye me-2"></i></button>
                            <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-primary uploadCertificate"><i class="fas fa-upload me-2"></i></button>
                            <!-- <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteAdminbtn"><i
                                class="far fa-trash-alt"></i></button> -->
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
  <?php include('../../includes/scripts.php'); ?>
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

      $(document).on('click', '.viewEmployeebtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'employee_action.php',
          type: 'post',
          data: {
            'checking_viewAdmintbtn': true,
            'user_id': userid,
          },
          success: function (response) {

            $('#EmployeeNumberTitle').html('Employee Info ');
            $('.admin_viewing_data').html(response);
            $('#viewEmployeeModal').modal('show');
          }
        });
      });

      //Admin Edit Modal
      $(document).on('click', '.editEmployeebtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "admin_action.php",
          data: {
            'checking_editEmployeebtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['name']);
              $('#edit_address').val(value['address']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#uploaded_image').html('<img src="../../../upload/admin/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_confirmPassword').val(value['password']);
            });

            $('#EditAdminModal').modal('show');
          }
        });
      });

      $(document).on('click', '.uploadCertificate', function () {
        var employeeNumber = $(this).data('id');

        $('#employeeNumber').val(employeeNumber);
        $('#uploadCertificateModal').modal('show');
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
            url: "employee_action.php",
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


  <?php include('../../includes/footer.php'); ?>