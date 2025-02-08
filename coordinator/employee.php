<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
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

  function loadUnitsForDepartmentedit() {
    var departmentId = $('#edit_department_id').val();

    if (departmentId) {
      $('#edit_unit_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId },
        success: function (response) {
          try {
            var units = JSON.parse(response);
            var unitSelect = $('#edit_unit_id');

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
          $('#edit_unit_id').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#edit_unit_id').html('<option value="">Select Unit</option>');
    }
  }

  function addloadUnitsForDepartmentedit() {
    var departmentId1 = $('#edit_department_id1').val();

    if (departmentId1) {
      $('#edit_unitSection').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId1 },
        success: function (response) {
          try {
            var units1 = JSON.parse(response);
            var unitSelect1 = $('#edit_unitSection');

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
          $('#edit_unitSection').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#edit_unitSection').html('<option value="">Select Unit</option>');
    }
  }

  function loadCoordinatoredit() {
    var unitId = $('#edit_unitSection').val();

    if (unitId) {
      $('#edit_coordinator_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_coordinator.php',
        type: 'GET',
        data: { unit_id: unitId },
        success: function (response) {
          try {
            var coordinators = JSON.parse(response);
            var coordinatorSelect = $('#edit_coordinator_id');

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
          $('#edit_coordinator_id').html('<option value="">Select Coordinator</option>');
        }
      });
    } else {
      $('#edit_coordinator_id').html('<option value="">Select Coordinator</option>');
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
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Employee Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="EmployeeNumber" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-8"></div>
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
                    <span class="text-danger">*</span>
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
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="ContactNumber" required>
                  </div>
                </div>
              </div>

              <div class="row">
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
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Position</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Position" class="form-control" required>
                  </div>
                </div>
              </div>

              <hr>

              <!-- <div class="form-group">
                <span class="text-danger">*</span>
                <label style="font-weight: normal;">Please ensure you select the department before choosing the unit
                  and
                  coordinator options.</label>
              </div> -->

              <div class="row mt-4">
                <!-- Department -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Department</label>
                    <span class="text-danger">*</span>
                    <select id="department_id1" name="Department" class="form-control" readonly required>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        // SQL query to fetch department, unit, and coordinator info
                        $sql = "SELECT 
                              tblcoordinator.*, 
                              department.id AS department_id, 
                              department.name AS department_name, 
                              unit.unit_name AS unit_name
                          FROM tblcoordinator
                          LEFT JOIN department ON tblcoordinator.division_id = department.id
                          LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
                          WHERE tblcoordinator.id = '" . $_SESSION['auth_user']['user_id'] . "'";

                        $query_run = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($query_run)) {
                          // Display the department name
                          echo "<option name='' value='" . $row['department_id'] . "'>" . $row['department_name'] . "</option>";
                          ;
                        }
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Unit/Section -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Unit/Section</label>
                    <span class="text-danger">*</span>
                    <select id="unitSection" name="UnitSection" class="form-control" readonly required>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        // SQL query to fetch department, unit, and coordinator info
                        $sql = "SELECT 
                              tblcoordinator.*, 
                              unit.id AS unit_id, 
                              department.name AS department_name, 
                              unit.unit_name AS unit_name
                          FROM tblcoordinator
                          LEFT JOIN department ON tblcoordinator.division_id = department.id
                          LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
                          WHERE tblcoordinator.id = '" . $_SESSION['auth_user']['user_id'] . "'";

                        $query_run = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($query_run)) {
                          // Display the department name
                          echo "<option name='' value='" . $row['unit_id'] . "'>" . $row['unit_name'] . "</option>";
                          ;
                        }
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <!-- Coordinator -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Coordinator</label>
                    <span class="text-danger">*</span>
                    <select id="coordinator_id" name="coordinator_id" class="form-control" required readonly>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        // SQL query to fetch department, unit, and coordinator info
                        $sql = "SELECT 
                              tblcoordinator.*, 
                              department.name AS department_name, 
                              unit.unit_name AS unit_name
                          FROM tblcoordinator
                          LEFT JOIN department ON tblcoordinator.division_id = department.id
                          LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
                          WHERE tblcoordinator.id = '" . $_SESSION['auth_user']['user_id'] . "'";

                        $query_run = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($query_run)) {
                          // Display the department name
                          echo "<option name='' value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                          ;
                        }
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </select>
                  </div>
                </div>
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

    <div class="modal fade" id="EditEmployeeModal">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editEmployeeForm" action="employee_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <input type="hidden" name="employee_id" id="employee_id" value="">

                <!-- Employee Number -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Employee Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="EmployeeNumber" id="editEmployeeNumber" class="form-control" required
                      readonly>
                  </div>
                </div>

                <div class="col-sm-8"></div>

                <!-- Lastname -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Lastname</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Lastname" id="editLastname" class="form-control" required>
                  </div>
                </div>

                <!-- Firstname -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Firstname</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Firstname" id="editFirstname" class="form-control" required>
                  </div>
                </div>

                <!-- Middlename -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Middlename</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Middlename" id="editMiddlename" class="form-control">
                  </div>
                </div>

                <!-- Suffix -->
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Suffix</label>
                    <input type="text" name="Suffix" id="editSuffix" class="form-control">
                  </div>
                </div>
              </div>

              <!-- Birthday and Contact Number -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Birthday</label>
                    <span class="text-danger">*</span>
                    <input type="date" name="Birthday" id="editBirthday" class="form-control" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="ContactNumber" id="editContactNumber" required>
                  </div>
                </div>
              </div>

              <!-- Sex and Position -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Sex</label>
                    <span class="text-danger">*</span>
                    <select name="Sex" id="editSex" class="form-control" required>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Position</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="Position" id="editPosition" class="form-control" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Department</label>
                    <span class="text-danger">*</span>
                    <select id="department" class="form-control" required disabled>
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
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Unit</label>
                    <span class="text-danger">*</span>
                    <select id="unit" class="form-control" required disabled>
                      <option value="">Select Unit</option>
                      <?php
                      $sql = "SELECT * FROM unit";
                      $query_run = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No Unit available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Coordinator</label>
                    <span class="text-danger">*</span>
                    <select id="coordinator" class="form-control" required disabled>
                      <option value="">Select Coordinator</option>
                      <?php
                      $sql = "SELECT * FROM tblcoordinator";
                      $query_run = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No Coordinator available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <hr>

              <div class="form-group">
                <h5 style="font-weight: bold;">EDIT DEPARTMENT, UNIT AND COORDINATOR</h5>
              </div>

              <!-- Department, Unit, and Coordinator -->
              <div class="form-group">
                <span class="text-danger">*</span>
                <label style="font-weight: normal;">Please ensure you select the department before choosing the unit and
                  coordinator options.</label>
              </div>

              <div class="row mt-4">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Department</label>
                    <span class="text-danger">*</span>
                    <select id="edit_department_id1" name="Department" class="form-control" required
                      onchange="addloadUnitsForDepartmentedit()">
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

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Unit/Section</label>
                    <span class="text-danger">*</span>
                    <select id="edit_unitSection" name="UnitSection" class="form-control"
                      onchange="loadCoordinatoredit()" required>
                      <option value="">Select Unit</option>
                      <!-- Units will be dynamically loaded here -->
                    </select>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Coordinator</label>
                    <span class="text-danger">*</span>
                    <select id="edit_coordinator_id" name="coordinator_id" class="form-control" required>
                      <option value="">Select Coordinator</option>
                      <!-- Coordinators will be dynamically loaded here -->
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="editEmployee" class="btn btn-primary">Submit</button>
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
                <label>Certificate Title (Date of Training)</label>
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
                <li class="breadcrumb-item active">Employee</li>
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
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Employee List</h3>
                  <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                    data-target="#AddEmployeeModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Employees</button>
                </div>
                <div class="card-body">
                  <table id="employee_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Employee #</th>
                        <th class="export">Name</th>
                        <th class="export">Contact No.</th>
                        <th class="export">Sex</th>
                        <th class="export">Position</th>
                        <th class="export">Department</th>
                        <th class="export">Unit</th>
                        <!-- <th class="export" width="5%">Status</th> -->
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
                            WHERE tblemployee.coordinator_id = $user AND Status = 1";

                    $query_run = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($query_run)) { ?>
                        <tr>
                          <!-- <td style="text-align: center;" width="10%"><img src="../../../upload/Employees/<?= $row['image'] ?>" class="img-thumbnail img-circle" width="50" alt=""></td> -->
                          <td><?php echo $row['EmployeeNumber']; ?></td>
                          <td>
                            <?php echo $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Suffix']; ?>
                          </td>
                          <td><?php echo $row['ContactNumber']; ?></td>
                          <td><?php
                          if ($row['Sex'] == 'F') {
                            echo "Female";
                          } elseif ($row['Sex'] == 'M') {
                            echo "Male";
                          } else {
                            echo "Not Specified";
                          }
                          ?></td>
                          <td><?php echo $row['Position']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>

                          <!-- <td>
                            <?php
                            if ($row['Status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-success activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['Status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                            ?>
                          </td> -->
                          <td style="width: 150px;">
                            <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-primary uploadCertificate"><i class="fas fa-upload me-2"></i></button>
                            <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-secondary viewEmployeebtn"><i class="fas fa-eye me-2"></i></button>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editEmployeebtn"><i
                                class="fas fa-edit me-2"></i></button>
                          </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="search">Employee #</th>
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

      $(document).ready(function () {
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
          }],
          initComplete: function () {
            // Apply the search filter to each column
            this.api().columns().every(function () {
              var that = this;
              $('input', this.footer()).on('keyup change clear', function () {
                if (that.search() !== this.value) {
                  that.search(this.value).draw();
                }
              });
            });
          }
        });

        // Trigger filterTable when filter inputs change
        $('#filter_form').on('change', function () {
          filterTable();  // Trigger the filtering
        });
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

      $(document).on('click', '.editEmployeebtn', function () {
        var employeeId = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "employee_action.php",
          data: {
            'getEmployeeDetails': true,
            'employee_id': employeeId,
          },
          success: function (response) {
            var data = JSON.parse(response);

            // Populate the modal fields with the employee's current details
            $('#employee_id').val(data.id);
            $('#editEmployeeNumber').val(data.EmployeeNumber);
            $('#editLastname').val(data.Lastname);
            $('#editFirstname').val(data.Firstname);
            $('#editMiddlename').val(data.Middlename);
            $('#editSuffix').val(data.Suffix);
            $('#editBirthday').val(data.Birthday);
            $('#editContactNumber').val(data.ContactNumber);
            $('#editSex').val(data.Sex);
            $('#editPosition').val(data.Position);

            // Populate the Department dropdown
            $('#department').val(data.Department);
            $('#unit').val(data.UnitSection);
            $('#coordinator').val(data.coordinator_id);

            // Show the modal to edit the employee
            $('#EditEmployeeModal').modal('show');
          },
          error: function () {
            alert("Error fetching employee data.");
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

  <?php include('includes/footer.php'); ?>