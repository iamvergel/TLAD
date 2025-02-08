<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<script>
  function filterTable() {
    var departmentId = document.getElementById("department_id").value;
    var unitId = document.getElementById("unit_id").value;

    // Make an AJAX request to filter data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "filter_admin_data.php?department_id=" + departmentId + "&unit_id=" + unitId, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Update the table with the filtered data
        document.querySelector('#employee_table tbody').innerHTML = xhr.responseText;

        // Re-initialize DataTable after filtering and redrawing the table
        var table = $('#employee_table').DataTable();
        table.clear().draw(); // Ensure it clears and redraws the table
        table.rows.add($(xhr.responseText)).draw(); // Add new data to DataTable
      }
    };
    xhr.send();
  }

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
    <div id="employeeDetails" class="content-wrapper  d-none">
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
      <div  class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title" id="EmployeeNumberTitle">Employee Information</h3>
                <button type="button" class="btn btn-secondary float-right" id="closeEmployeeDetails">
                  BACK
                </button>
              </div>
              <div class="card-body">
                <div class="admin_viewing_data"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-wrapper main">
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
      <div class="content">
        <div class="container-fluid">
          <?php include('../../message.php'); ?>
          <div class="row">
            <div class="col-md-12 col-lg-3 col-xl-2">
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

            <div class="col-md-12 col-lg-9 col-xl-10">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Employee List</h3>
                  <!-- <button type="button" class="btn btn-primary btn-sm float-right ml-2" data-toggle="modal"
                    data-target="#AddEmployeeModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Employee</button>

                  <button type="button" class="btn btn-success btn-sm float-right me-2" data-toggle="modal"
                    data-target="#addYearModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Year</button> -->
                </div>
                <div class="card-body">
                  <table id="employee_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Employee #</th>
                        <th class="export">Name</th>
                        <th class="export">Contact No.</th>
                        <th class="export">Gender</th>
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
                                  WHERE tblemployee.Status = 0;
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
                            <!-- <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-primary uploadCertificate"><i class="fas fa-upload me-2"></i></button> -->
                            <button data-id="<?php echo $row['EmployeeNumber']; ?>"
                              class="btn btn-sm btn-secondary viewEmployeebtn"><i class="fas fa-eye me-2"></i></button>
                            <!-- <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editEmployeebtn"><i
                                class="fas fa-edit me-2"></i></button> -->
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
                        <th class="search">Employee #</th>
                        <th class="search">Name</th>
                        <th class="search">Contact No.</th>
                        <th class="search">Gender</th>
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
              modifier: {
                page: 'current',  // Only export the visible rows on the current page
                search: 'none'    // Don't include search filters in export
              },
              columns: '.export'
            }
          },
          {
            extend: 'csvHtml5',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="far fa-file-csv"></i>  CSV',
            exportOptions: {
              modifier: {
                page: 'current',  // Only export the visible rows on the current page
                search: 'none'    // Don't include search filters in export
              },
              columns: '.export'
            }
          },
          {
            extend: 'excel',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="far fa-file-excel"></i>  Excel',
            exportOptions: {
              modifier: {
                page: 'current',  // Only export the visible rows on the current page
                search: 'none'    // Don't include search filters in export
              },
              columns: '.export'
            }
          },
          {
            extend: 'pdfHtml5',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="far fa-file-pdf"></i>  PDF',
            exportOptions: {
              modifier: {
                page: 'current',  // Only export the visible rows on the current page
                search: 'none'    // Don't include search filters in export
              },
              columns: '.export'
            }
          },
          {
            extend: 'print',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="fas fa-print"></i>  Print',
            exportOptions: {
              modifier: {
                page: 'current',  // Only export the visible rows on the current page
                search: 'none'    // Don't include search filters in export
              },
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
            // Show employee details and hide the rest of the page
            $('#EmployeeNumberTitle').html('Employee Info');
            $('.admin_viewing_data').html(response);

            // Hide the employee list and show the employee details section
            $('#employeeDetails').removeClass('d-none'); // Show employee details
            $('.main').addClass('d-none'); // Hide the main content
          }
        });
      });

      // Close the employee details view
      $(document).on('click', '#closeEmployeeDetails', function () {
        // Hide employee details and show the main content
        $('#employeeDetails').addClass('d-none'); // Hide employee details
        $('.main').removeClass('d-none'); // Show the main content
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

  <?php include('../../includes/footer.php'); ?>