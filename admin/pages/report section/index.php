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
    var year = document.getElementById("year").value;
    var remarks = document.getElementById("Remarks").value;  // Get Remarks value

    // Make an AJAX request to fetch the filtered data
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "filter_admin_data.php?department_id=" + departmentId + "&unit_id=" + unitId + "&year=" + year + "&remarks=" + remarks, true);
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
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Report Section</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Report Section</li>
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
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">SELECT DEPARTMENT AND UNIT</h3>
                </div>
                <div class="row px-3 py-2">
                  <div class="col-md-12 mt-2">
                    <div class="form-group">
                      <label>Division</label><span class="text-danger">*</span>
                      <select id="department_id" name="department_id" class="form-control" required
                        onchange="loadUnitsForDepartment()">
                        <option value="">Select Division</option>
                        <?php
                        include('../../config/dbconn.php');
                        $sql = "SELECT * FROM department";
                        $query_run = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($query_run) > 0) {
                          while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                          }
                        } else {
                          echo "<option value=''>No division available</option>";
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

                  <div class="col-md-12 mt-2">
                    <div class="form-group">
                      <label>Year</label><span class="text-danger">*</span>
                      <select id="year" name="year" class="form-control" required>
                        <option value="">Select Year</option>
                        <?php
                        // Select distinct years from the tblemployeeremarks table
                        $sql = "SELECT DISTINCT Year FROM tblemployeeremarks ORDER BY Year DESC";
                        $query_run = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($query_run) > 0) {
                          // Display each distinct year as an option
                          while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<option value='" . $row['Year'] . "'>" . $row['Year'] . "</option>";
                          }
                        } else {
                          echo "<option value=''>No years available</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12 mt-2">
                    <div class="form-group">
                      <label>Remarks</label><span class="text-danger">*</span>
                      <select id="Remarks" name="Remarks" class="form-control" required>
                        <option value="">Select Remarks</option>
                        <option value="1">WITH TRAINING</option>
                        <option value="0">WITHOUT TRAINING</option>
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
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Employee List</h3>
                  <!-- <button type="button" class="btn btn-success btn-sm float-right ml-2" data-toggle="modal"
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
                        <th class="export">Name</th>
                        <th class="export">Position</th>
                        <th class="export">Division</th>
                        <th class="export">Unit</th>
                        <th class="export">Title</th>
                        <th class="export">Remarks</th>
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
                                    unit.unit_name AS unit_name,
                                    tblemployeeremarks.Remarks As Remarks,
                                    tblemployeeremarks.Title As Title
                                  FROM tblemployee
                                  LEFT JOIN department ON tblemployee.Department = department.id
                                  LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                                  LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
                                  WHERE tblemployee.Status = 1;
                                ";

                      $query_run = mysqli_query($conn, $sql);

                      if (!$query_run) {
                        die('Query Failed: ' . mysqli_error($conn));
                      }


                      while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['Lastname'] . ' ' . $row['Firstname'] . ' ' . $row['Suffix'] . ' ' . $row['Middlename']; ?>
                          </td>
                          <td><?php echo $row['Position']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>
                          <td><?php echo $row['Title']; ?></td>
                          <td style="width: 200px;">
                            <?php
                              if ($row['Remarks'] == '1') {
                                echo "<p class='text-success' style='font-weight: bold;'>WITH TRAINING</p>";
                              } elseif ($row['Remarks'] == '0') {
                                echo "<p class='text-danger' style='font-weight: bold;'>WITHOUT TRAINING</p>";
                              } else {
                                echo "Not Specified";
                              } 
                            ?>
                          </td>
                          <?php
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="search">Name</th>
                        <th class="search">Position</th>
                        <th class="search">Division</th>
                        <th class="search">Unit</th>
                        <th class="search">Status</th>
                        <th class="search">Title</th>
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
      // Initialize column search input in footer
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
    });
  </script>

  <?php include('../../includes/footer.php'); ?>