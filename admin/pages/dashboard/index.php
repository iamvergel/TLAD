<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<?php
$current_year = date("Y");

// Fetching training and non-training employee counts
$sql = "
  SELECT 
      tblemployeeremarks.Remarks AS training_status, 
      COUNT(tblemployee.EmployeeNumber) AS employee_count
  FROM tblemployee
  LEFT JOIN tblemployeeremarks ON tblemployee.EmployeeNumber = tblemployeeremarks.EmployeeNumber
  WHERE tblemployee.Status = 1
    AND (tblemployeeremarks.Year = $current_year OR tblemployeeremarks.Year IS NULL) -- Handle employees without remarks for this year
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

// Fetching total number of employees
$sql_total = "SELECT COUNT(EmployeeNumber) AS total FROM tblemployee WHERE Status = 1";
$query_run_total = mysqli_query($conn, $sql_total);
$total_employees = 0;

if ($query_run_total && mysqli_num_rows($query_run_total) > 0) {
  $row = mysqli_fetch_array($query_run_total);
  $total_employees = $row['total'];
}
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
              <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS employee_count FROM tblemployee WHERE Status = 1";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Active Employees</label>";
                    } else {
                      echo "<h3>No active employees found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="../../../admin/pages/employees/" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS coordinator_count FROM tblcoordinator WHERE Status = 1";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['coordinator_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Active Coordinator</label>";
                    } else {
                      echo "<h3>No active Coordinator found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="../../../admin/pages/coordinator/" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS admin_count FROM tbladmin";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['admin_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Admin</label>";
                    } else {
                      echo "<h3>No active Admin found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="../../../admin/pages/coordinator/" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS employee_count FROM tblemployee WHERE Status = 0";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['employee_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Inactive Employees</label>";
                    } else {
                      echo "<h3>No Inactive employees found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <a href="../../../admin/pages/inactive_employees/" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS department_count FROM department";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['department_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Divisions</label>";
                    } else {
                      echo "<h3>No Division found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-building"></i>
                  </div>
                  <a href="../../../admin/pages/department/" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>

              <div class="col-lg-4 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <?php
                    // SQL query to count all active employees (Status = 1)
                    $sql = "SELECT COUNT(*) AS unit_count FROM unit";
                    $query_run = mysqli_query($conn, $sql);

                    if ($query_run && mysqli_num_rows($query_run) > 0) {
                      $row = mysqli_fetch_array($query_run);
                      echo "<h1 style='font-weight: bold; font-size: 50px;'>" . $row['unit_count'] . "</h1>";
                      echo "<label style='text-transform: uppercase;'>Units</label>";
                    } else {
                      echo "<h3>No Units found.</h3>";
                    }
                    ?>
                  </div>
                  <div class="icon">
                    <i class="fas fa-building"></i>
                  </div>
                  <a href="../../../admin/pages/unit/" class="small-box-footer">
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
                  <a href="index.php" class="small-box-footer">
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
  </div>

  <?php include('../../includes/scripts.php'); ?>

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

  <?php include('../../includes/footer.php'); ?>