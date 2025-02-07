<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">

        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    // Get the logged-in user's ID
                    $user = $_SESSION['auth_user']['user_id'];

                    // Query to get the department name, unit name, and employee count for the user
                    $sql = "
                        SELECT 
                            department.name AS department_name, 
                            unit.unit_name AS unit_name,
                            COUNT(tblemployee.EmployeeNumber) AS employee_count
                        FROM tblemployee
                        LEFT JOIN department ON tblemployee.Department = department.id
                        LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                        WHERE tblemployee.coordinator_id = $user
                        GROUP BY department.name, unit.unit_name
                        LIMIT 1";
                                        
                    $query_run = mysqli_query($conn, $sql);

                    // Check if the query returns any results
                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      // Fetch the row
                      $row = mysqli_fetch_array($query_run);

                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<h5 style='text-transform: uppercase;'>" . $row['department_name'] . ' / ' . $row['unit_name'] . "</h5>";
                      
                    } else {
                      // No matching department, unit, or employees found for the user
                      echo "<h5>No department or unit found for this user.</h5>";
                      echo "<h3>No employees found for this user.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-friends"></i>
                  </div>
                  <a href="employee.php" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </div>
    </div>
    <div class="wrapper">
      <div class="modal fade" id="AppointmentDetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="modalTitle" class="modal-title">Appointment Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modalBody" class="modal-body">
              <div class="viewdetails">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>



    <?php include('includes/footer.php'); ?>