<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../config/dbconn.php');
?>
<style>
  .sign {
    position: absolute;
    bottom: 10px;
    right: 100px;
    font-size: 12px;
  }
</style>

<body>
  <div class="wrapper ">
    <div class="row  ">
      <div class="col-md-12">
        <div class="invoice p-3 mb-3" id="prescription">
          <div class="row d-flex justify-content-start">
            <div class="col-md-9">
              <h4 class="text-primary text-center top_title"><?= $system_name ?>
                <address class="text-left text-dark">
                  <span class="font-weight-bold">Address:</span> <?= $address ?><br>
                  <span class="font-weight-bold">Telephone:</span> <?= $telno ?><br>
                  <span class="font-weight-bold">Mobile:</span> <?= $mobile ?><br>
                  <span class="font-weight-bold"> Email:</span> <?= $email ?>
                </address>
            </div>
            <!-- <div class="col-md-3 d-flex justify-content-end">
              <img src="../../../upload/<?= $system_logo ?>" height="130" alt="Logo">
            </div> -->
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
                <div class="mb-2 d-flex justify-content-start ">
                  <div class=" d-flex flex-row justify-content-start w-100">
                    <span class="font-weight-bold">Name:</span> <?= $user['pname']; ?>
                  </div>

                  <div class="d-flex flex-row justify-content-start w-100 ">
                    <span class="font-weight-bold">Address:</span><?= $user['address']; ?>
                  </div>

                </div>
                <hr>
                <div class="mb-2 d-flex justify-content-start  ">
                  <div class=" d-flex flex-row justify-content-start w-100">
                    <span class="font-weight-bold">Gender:</span> <?= $user['gender']; ?>
                  </div>
                  <div class="d-flex flex-row justify-content-start w-100 ">
                    <span class="font-weight-bold">Age:</span> <?= $user['Age']; ?>
                  </div>
                  <div class="d-flex flex-row justify-content-start w-100 ">
                    <span class="font-weight-bold">Date:</span><?= date('M j, Y', strtotime($user['date'])); ?>
                  </div>

                </div>
                <hr>
                <div class=" ">
                  <div class="col-md-2  d-flex  ">
                    <img src="../../../upload/rx.png" height="160" alt="Logo">
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
  <div class="sign  border-1">
    <div class=" text-sm">
      <div class=" text-left">
        <span class=" "><span class="font-weight-bold">Signature</span></span></br>
        <span class=" "><span class="font-weight-bold">Lic No:</span> </span></br>
        <span class=" "><span class="font-weight-bold">PTR No:</span> </span></br>
        <span class=" "><span class="font-weight-bold">Doctor: </span><?= $user['doctor_name']; ?></span></br>

      </div>
    </div>
  </div>

  </div>

  <script>
    window.addEventListener("load", window.print());
  </script>
</body>

</html>