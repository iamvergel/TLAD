<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');

function getTotalIncome($conn, $dateRange)
{
    $sql = "
        SELECT SUM(payment) AS total_payment 
        FROM (
            SELECT payment FROM tblappointment WHERE payment != '' AND schedule >= $dateRange
            UNION ALL
            SELECT payment FROM tblwalkinappointment WHERE payment != '' AND schedule >= $dateRange
        ) AS combined_payments
    ";

    $query_run = mysqli_query($conn, $sql);

    if (!$query_run) {
        error_log("Query Failed: " . mysqli_error($conn));
        return 0;
    }

    $row = mysqli_fetch_assoc($query_run);
    return $row['total_payment'] ? $row['total_payment'] : 0;
}

$daily_income = getTotalIncome($conn, "CURDATE()");
$weekly_income = getTotalIncome($conn, "CURDATE() - INTERVAL 7 DAY");
$monthly_income = getTotalIncome($conn, "CURDATE() - INTERVAL 1 MONTH");
$yearly_income = getTotalIncome($conn, "CURDATE() - INTERVAL 1 YEAR");

$total_gross_income = $yearly_income;

?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="content-wrapper">

                <div class="content-header">
                    <section class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Income report</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active">Income report</li>
                                </ol>
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->
                    </section><!-- /.container-fluid -->
                </div>


                <div class="content">
                    <div class="container-fluid">
                        <canvas class="p-5 bg-light" id="incomeChart" width="400" height="100"></canvas>

                        <h3 class="px-5"><small>Total Gross Income:</small>
                            ₱<?php echo number_format($total_gross_income, 2); ?></h3>

                        <div class="container-fluid border-top border-primary rounded-4 shadow my-5 p-2">
                            <div class="btn-group mb-3 p-5" role="group" aria-label="Income Time Range">
                                <button type="button" class="btn btn-primary" id="btnDaily">Daily</button>
                                <button type="button" class="btn btn-primary" id="btnWeekly">Weekly</button>
                                <button type="button" class="btn btn-primary" id="btnMonthly">Monthly</button>
                                <button type="button" class="btn btn-primary" id="btnYearly">Yearly</button>
                            </div>


                            <!-- Daily Income Table -->
                            <div id="dailyIncome" class="tab-pane fade show active px-5" role="tabpanel"
                                aria-labelledby="all-tab">
                                <table id="dailyTbl" class="table table-borderless table-hover" style="width: 100%;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="export">Patient</th>
                                            <th class="export">Date Submitted</th>
                                            <th class="export">Appointment Date</th>
                                            <th class="export">Start Time</th>
                                            <th class="export">End Time</th>
                                            <th class="export">Payment</th>
                                            <th class="export">Payment Option</th>
                                            <th class="export">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblwalkinappointment 
                    WHERE payment != '' AND schedule >= CURDATE()
                    UNION ALL
                    SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblappointment
                    WHERE payment != '' AND schedule >= CURDATE()";
                                        $query_run = mysqli_query($conn, $sql);
                                        $totalPayment = 0;

                                        if ($query_run) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $totalPayment += $row['payment'];
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['schedule']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['starttime']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['endtime']); ?></td>
                                                    <td>₱<?php echo number_format($row['payment'], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row['payment_option']); ?></td>
                                                    <td>
                                                        <?php
                                                        $status = htmlspecialchars($row['status']);
                                                        $status_class = '';

                                                        if ($status == 'Confirmed') {
                                                            $status_class = 'bg-success';
                                                        } elseif ($status == 'Reschedule') {
                                                            $status_class = 'bg-secondary';
                                                        } elseif ($status == 'Treat') {
                                                            $status_class = 'bg-info';
                                                        }

                                                        echo "<span class='badge $status_class'>$status</span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Total Payment:</strong></td>
                                            <td colspan="3" class="text-start">
                                                <strong>₱<?php echo number_format($totalPayment, 2); ?></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>



                            <!-- Weekly Income Table -->
                            <div id="weeklyIncome" class="tab-pane px-5" style="display: none;">
                                <table id="weeklyTbl" class="table table-borderless table-hover" style="width: 100%;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="export">Patient</th>
                                            <th class="export">Date Submitted</th>
                                            <th class="export">Appointment Date</th>
                                            <th class="export">Start Time</th>
                                            <th class="export">End Time</th>
                                            <th class="export">Payment</th>
                                            <th class="export">Payment Option</th>
                                            <th class="export">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // SQL query to fetch data and also the total payment
                                        $sql = "SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblwalkinappointment 
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 7 DAY
                    UNION ALL
                    SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblappointment
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 7 DAY";
                                        $query_run = mysqli_query($conn, $sql);
                                        $totalPayment = 0;

                                        if ($query_run) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                // Accumulate the total payment
                                                $totalPayment += $row['payment'];
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['schedule']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['starttime']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['endtime']); ?></td>
                                                    <td>₱<?php echo number_format($row['payment'], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row['payment_option']); ?></td>
                                                    <td>
                                                        <?php
                                                        $status = htmlspecialchars($row['status']);
                                                        $status_class = '';

                                                        if ($status == 'Confirmed') {
                                                            $status_class = 'bg-success';
                                                        } elseif ($status == 'Reschedule') {
                                                            $status_class = 'bg-secondary';
                                                        } elseif ($status == 'Treat') {
                                                            $status_class = 'bg-info';
                                                        }

                                                        echo "<span class='badge $status_class'>$status</span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <!-- Add a row for the total payment at the bottom of the table -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Total Payment:</strong></td>
                                            <td colspan="3" class="text-start">
                                                <strong>₱<?php echo number_format($totalPayment, 2); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <!-- Monthly Income Table -->
                            <div id="monthlyIncome" class="tab-pane px-5" style="display: none;">
                                <table id="monthlyTbl" class="table table-borderless table-hover" style="width: 100%;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="export">Patient</th>
                                            <th class="export">Date Submitted</th>
                                            <th class="export">Appointment Date</th>
                                            <th class="export">Start Time</th>
                                            <th class="export">End Time</th>
                                            <th class="export">Payment</th>
                                            <th class="export">Payment Option</th>
                                            <th class="export">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblwalkinappointment 
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 1 MONTH
                    UNION ALL
                    SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblappointment
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 1 MONTH";
                                        $query_run = mysqli_query($conn, $sql);
                                        $totalPayment = 0;  // Initialize total payment variable
                                        
                                        if ($query_run) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $totalPayment += $row['payment'];  // Accumulate payment
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['schedule']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['starttime']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['endtime']); ?></td>
                                                    <td>₱<?php echo number_format($row['payment'], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row['payment_option']); ?></td>
                                                    <td>
                                                        <?php
                                                        $status = htmlspecialchars($row['status']);
                                                        $status_class = '';

                                                        if ($status == 'Confirmed') {
                                                            $status_class = 'bg-success';
                                                        } elseif ($status == 'Reschedule') {
                                                            $status_class = 'bg-secondary';
                                                        } elseif ($status == 'Treat') {
                                                            $status_class = 'bg-info';
                                                        }

                                                        echo "<span class='badge $status_class'>$status</span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <!-- Footer for Total Payment -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Total Payment:</strong></td>
                                            <td colspan="3" class="text-start">
                                                <strong>₱<?php echo number_format($totalPayment, 2); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div id="yearlyIncome" class="tab-pane px-5" style="display: none;">
                                <table id="yearlyTbl" class="table table-borderless table-hover" style="width: 100%;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="export">Patient</th>
                                            <th class="export">Date Submitted</th>
                                            <th class="export">Appointment Date</th>
                                            <th class="export">Start Time</th>
                                            <th class="export">End Time</th>
                                            <th class="export">Payment</th>
                                            <th class="export">Payment Option</th>
                                            <th class="export">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblwalkinappointment 
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 1 YEAR
                    UNION ALL
                    SELECT patient_name, created_at, schedule, starttime, endtime, payment, payment_option, status 
                    FROM tblappointment
                    WHERE payment != '' AND schedule >= CURDATE() - INTERVAL 1 YEAR";
                                        $query_run = mysqli_query($conn, $sql);
                                        $totalPayment = 0;  // Initialize total payment variable
                                        
                                        if ($query_run) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                                $totalPayment += $row['payment'];  // Accumulate payment
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['patient_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['schedule']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['starttime']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['endtime']); ?></td>
                                                    <td>₱<?php echo number_format($row['payment'], 2); ?></td>
                                                    <td><?php echo htmlspecialchars($row['payment_option']); ?></td>
                                                    <td>
                                                        <?php
                                                        $status = htmlspecialchars($row['status']);
                                                        $status_class = '';

                                                        if ($status == 'Confirmed') {
                                                            $status_class = 'bg-success';
                                                        } elseif ($status == 'Reschedule') {
                                                            $status_class = 'bg-secondary';
                                                        } elseif ($status == 'Treat') {
                                                            $status_class = 'bg-info';
                                                        }

                                                        echo "<span class='badge $status_class'>$status</span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='8'>No data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <!-- Footer for Total Payment -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Total Payment:</strong></td>
                                            <td colspan="3" class="text-start">
                                                <strong>₱<?php echo number_format($totalPayment, 2); ?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <!-- Include necessary libraries for DataTables and Chart.js -->
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="total-income.js"></script>

                            <script>
                                $(document).ready(function () {

                                    var ctx = document.getElementById('incomeChart').getContext('2d');
                                    var incomeChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: ['Daily', 'Weekly', 'Monthly', 'Yearly'],
                                            datasets: [{
                                                label: 'Income',
                                                data: [<?php echo $daily_income; ?>, <?php echo $weekly_income; ?>, <?php echo $monthly_income; ?>, <?php echo $yearly_income; ?>],
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 2,
                                                tension: 0.4
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            scales: {
                                                y: { beginAtZero: true }
                                            },
                                            plugins: { legend: { position: 'top' } }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



<?php include('../../includes/scripts.php'); ?>
<?php include('../../includes/footer.php'); ?>