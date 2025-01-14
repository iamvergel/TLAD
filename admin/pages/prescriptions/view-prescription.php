<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="invoice p-3 mb-3" id="prescription">
                <div class="row d-flex justify-content-start">
                  <div class="w-100">
                    <h4 class="text-primary text-center top_title"><?= $system_name ?>
                    </h4>
                    <address class="text-left text-dark">
                      <span class="font-weight-bold">Address:</span> <?= $address ?><br>
                      <span class="font-weight-bold">Telephone:</span> <?= $telno ?><br>
                      <span class="font-weight-bold">Mobile:</span> <?= $mobile ?><br>
                      <span class="font-weight-bold"> Email:</span> <?= $email ?>
                    </address>
                  </div>

                </div>
                <hr>

                <?php
                if (isset($_GET['id'])) {
                  $user_id = $_GET['id'];
                  $user = "SELECT pres.*, CONCAT(p.fname,' ',p.lname) AS pname, p.gender, p.address, pres.dose, d.name AS doctor_name, pres.duration, d.name,pres.advice,pres.medicine,
                  DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),STR_TO_DATE(p.dob, '%c/%e/%Y'))), '%Y')+0 AS Age 
                  FROM prescription pres 
                  INNER JOIN tblpatient p ON p.id = pres.patient_id 
                  INNER JOIN tbldoctor d ON d.id = pres.doc_id 
                  WHERE pres.id='$user_id' LIMIT 1";
                  $users_run = mysqli_query($conn, $user);

                  if (mysqli_num_rows($users_run) > 0) {
                    foreach ($users_run as $user) {
                      ?>
                      <div class="row mb-2 d-flex justify-content-start text-sm">
                        <div class="col-md-4">
                          <span class="font-weight-bold">Name:</span> <?= $user['pname']; ?>
                        </div>
                        <div class="col-md-4">
                          <span class="font-weight-bold">Doctor:</span> <?= $user['doctor_name']; ?>
                        </div>
                        <div class="col-md-4">
                          <span class="font-weight-bold">Address:</span><?= $user['address']; ?>
                        </div>

                      </div>
                      <hr>
                      <div class="row mb-2 d-flex justify-content-start text-sm">
                        <div class="col-md-3">
                          <span class="font-weight-bold">Gender:</span> <?= $user['gender']; ?>
                        </div>
                        <div class="col-md-3">
                          <span class="font-weight-bold">Age:</span> <?= $user['Age']; ?> yrs old
                        </div>
                        <div class="col-md-3">
                          <span class="font-weight-bold">Date:</span> <?= date('M j, Y', strtotime($user['date'])); ?>
                        </div>
                      </div>
                      <hr>
                      <div class="container  h-20">
                        <div class="col-md-2  d-flex justify-content-end">
                          <img src="../../../upload/rx.png" height="160" alt="Logo">
                        </div>
                      </div>
                      <div class="row text-sm">
                        <div class="col-md-12 font-weight-bold text-left mb-4" style="margin-top:60px;">
                          Signature<br>
                          Lic No: <br>
                          PTR No: <br>
                        </div>
                      </div>
                      <div class="row no-print">
                        <div class="col-md-4">
                          <a href="print-prescription.php?id=<?= $user['id'] ?>" rel="noopener" target="_blank"
                            class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                      </div>
                      <?php
                    }
                  } else {
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('../../includes/scripts.php'); ?>
  <script>
    //download
    $('#download').click(function () {
      var pdf = new jsPDF('p', 'pt', 'letter');
      pdf.addHTML($('#prescription'), function () {
        pdf.save('prescription_id_341.pdf');
      });
    });
  </script>
  <?php include('../../includes/footer.php'); ?>