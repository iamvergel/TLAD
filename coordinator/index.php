<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
?>

<?php
$user = $_SESSION['auth_user']['user_id'];
$current_year = date("Y");

// Fetching training and non-training employee counts
$sql = "
  SELECT 
      tblemployeeremarks.Remarks AS training_status, 
      COUNT(tblemployee.EmployeeNumber) AS employee_count
  FROM tblemployee
  LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
  WHERE tblemployee.coordinator_id = $user 
    AND tblemployee.Status = 1
    AND tblemployeeremarks.Year = $current_year
  GROUP BY tblemployeeremarks.Remarks
";
$query_run = mysqli_query($conn, $sql);

// Initialize counts for training and non-training employees
$with_training = 0;
$without_training = 0;

// Fetch the results
if ($query_run && mysqli_num_rows($query_run) > 0) {
  while ($row = mysqli_fetch_array($query_run)) {
    if ($row['training_status'] == 1) {
      $with_training = $row['employee_count'];
    } else {
      $without_training = $row['employee_count'];
    }
  }
}

// Calculate total number of employees
$total_employees = $with_training + $without_training;
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
              <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    $user = $_SESSION['auth_user']['user_id'];
                    $sql = "
                      SELECT 
                          department.name AS department_name, 
                          unit.unit_name AS unit_name,
                          COUNT(tblemployee.EmployeeNumber) AS employee_count
                      FROM tblemployee
                      LEFT JOIN department ON tblemployee.Department = department.id
                      LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                      WHERE tblemployee.coordinator_id = $user AND tblemployee.Status = 1
                      GROUP BY department.name, unit.unit_name
                      LIMIT 1";
                    $query_run = mysqli_query($conn, $sql);
                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>" . $row['department_name'] . ' / ' . $row['unit_name'] . "</label> <p style='text-transform: uppercase;'>Active</p>";
                    } else {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'> 0 </h1>";
                      echo "<label style='text-transform: uppercase;'> Division / Unit </label> <p style='text-transform: uppercase;'>Active</p>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="employee.php" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                  <div class="inner">
                    <?php
                    $user = $_SESSION['auth_user']['user_id'];
                    $current_year = date("Y");
                    $sql = "
                      SELECT 
                          department.name AS department_name, 
                          unit.unit_name AS unit_name,
                          COUNT(tblemployee.EmployeeNumber) AS employee_count
                      FROM tblemployee
                      LEFT JOIN department ON tblemployee.Department = department.id
                      LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                      LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
                      WHERE tblemployee.coordinator_id = $user 
                        AND tblemployee.Status = 1
                        AND tblemployeeremarks.Remarks = 1
                        AND tblemployeeremarks.Year = $current_year
                      GROUP BY department.name, unit.unit_name
                      LIMIT 1";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>" . $row['department_name'] . ' / ' . $row['unit_name'] . "</label> <p style='text-transform: uppercase;'>WITH TRAINING (" . $current_year . ")</p>";
                    } else {
                      echo "<h1 style='font-weight: bold; font-size: 50px;'> 0 </h1>";
                      echo "<label style='text-transform: uppercase;'>No data available</label> <p style='text-transform: uppercase;'>WITH TRAINING (" . $current_year . ")</p>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="report_section.php" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-12">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <?php
                    $user = $_SESSION['auth_user']['user_id'];
                    $current_year = date("Y");
                    $sql = "
                      SELECT 
                          department.name AS department_name, 
                          unit.unit_name AS unit_name,
                          COUNT(tblemployee.EmployeeNumber) AS employee_count
                      FROM tblemployee
                      LEFT JOIN department ON tblemployee.Department = department.id
                      LEFT JOIN unit ON tblemployee.UnitSection = unit.id
                      LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
                      WHERE tblemployee.coordinator_id = $user 
                        AND tblemployee.Status = 1
                        AND tblemployeeremarks.Remarks = 0
                        AND tblemployeeremarks.Year = $current_year
                      GROUP BY department.name, unit.unit_name
                      LIMIT 1";
                    $query_run = mysqli_query($conn, $sql);
                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>" . $row['department_name'] . ' / ' . $row['unit_name'] . "</label> <p style='text-transform: uppercase;'>WITHOUT TRAINING (" . $current_year . ")</p>";
                    } else {
                      echo "<h1 style='font-weight: bold; font-size: 50px;'> 0 </h1>";
                      echo "<label style='text-transform: uppercase;'>No data available</label> <p style='text-transform: uppercase;'>WITH TRAINING (" . $current_year . ")</p>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="report_section.php" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-6 col-12 mt-5">
                <div class="small-box bg-light">
                  <div class="inner">
                    <canvas id="trainingChart" width="400" height="400"></canvas>
                  </div>
                  <div class="icon">
                    <i class="fas fa-chart-pie"></i>
                  </div>
                  <a href="report_section.php" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-6 col-12 mt-5">
                <div class="row">
                  <div class="col-12">
                    <div class="small-box bg-success p-3">
                      <div class="inner">
                        <h4 style="font-weight: bold">With Training Percentage: <br /> <br /> <span
                            id="withTrainingPercent" style="font-weight: normal">0%</span></h4>
                      </div>
                      <div class="icon">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="small-box bg-danger p-3">
                      <div class="inner">
                        <h4 style="font-weight: bold">Without Training Percentage: <br /> <br /> <span
                            id="withoutTrainingPercent" style="font-weight: normal">0%</span></h4>
                      </div>
                      <div class="icon">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <!-- Blank space as requested -->
                  </div>
                </div>
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
      </div>
    </div>
    <div class="wrapper">
      <!-- <div class="modal fade" id="AppointmentDetails">
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
      </div> -->
    </div>

    <?php include('includes/scripts.php'); ?>

    <script>
      var ctx = document.getElementById('trainingChart').getContext('2d');

      // Get the data from PHP (with and without training employee counts)
      var totalEmployees = <?php echo $total_employees; ?>;
      var withTraining = <?php echo $with_training; ?>;
      var withoutTraining = <?php echo $without_training; ?>;

      // Calculate the percentages
      var withTrainingPercentage = totalEmployees > 0 ? (withTraining / totalEmployees * 100).toFixed(1) : 0;
      var withoutTrainingPercentage = totalEmployees > 0 ? (withoutTraining / totalEmployees * 100).toFixed(1) : 0;

      // Update the HTML to show the percentages
      document.getElementById('withTrainingPercent').innerText = withTrainingPercentage + '% / 100%';
      document.getElementById('withoutTrainingPercent').innerText = withoutTrainingPercentage + '%';

      // Data for the pie chart
      var trainingData = {
        labels: ['With Training (' + withTrainingPercentage + '%)', 'Without Training (' + withoutTrainingPercentage + '%)'],
        datasets: [{
          data: [withTraining, withoutTraining],
          backgroundColor: ['#28a745', '#dc3545'],
          hoverBackgroundColor: ['#218838', '#c82333']
        }]
      };

      // Create the pie chart
      var trainingChart = new Chart(ctx, {
        type: 'pie',
        data: trainingData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top',
            },
            tooltip: {
              callbacks: {
                label: function (tooltipItem) {
                  return tooltipItem.label + ': ' + tooltipItem.raw + ' employees';
                }
              }
            },
            // Adding the datalabels plugin for percentages on the chart itself
            datalabels: {
              display: true,
              formatter: function (value, context) {
                var total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                var percentage = ((value / total) * 100).toFixed(1);
                return percentage + '%';
              },
              color: '#fff',
              font: {
                weight: 'bold',
                size: 16
              }
            }
          }
        }
      });
    </script>

    <?php include('includes/footer.php'); ?>