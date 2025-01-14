<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbconn.php');
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
            <div class="col-md-6">
              <?php
              include('message.php');
              ?>
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Editss Appointment</h3>
                  <a href="calendar.php" class="btn btn-outline-danger btn-sm float-right">
                    <i class="fas fa-long-arrow-left"></i> &nbsp;&nbsp;Back</a>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <form action="appointment_action.php" method="post">
                        <?php
                        if (isset($_GET['id'])) {
                          $user_id = $_GET['id'];
                          $sql = "SELECT * FROM tblappointment WHERE id = '$user_id' LIMIT 1";
                          $query_run = mysqli_query($conn, $sql);

                          if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                              ?>
                              <input type="hidden" id="edit_id" name="edit_id" value="<?= $row['id']; ?>">
                              <div class="form-group">
                                <label>Select Patient</label>
                                <span class="text-danger">*</span>
                                <select class="form-control select2 patient" name="select_patient" id="edit_patient"
                                  selected="selected" style="width: 100%;" required>
                                  <option selected disabled value="">Select Patient</option>
                                  <?php
                                  $sql = "SELECT * FROM tblpatient";
                                  $query_run = mysqli_query($conn, $sql);
                                  if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                      ?>
                                      <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                      </option>
                                      <?php
                                    }
                                  } else {
                                    ?>
                                    <option value="">No Record Found"</option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Select Dentist</label>
                                <span class="text-danger">*</span>
                                <select class="form-control select2 dentist" id="edit_doctor" name="select_dentist"
                                  style="width: 100%;" required>
                                  <option selected disabled value="">Select Doctor</option>
                                  <?php
                                  if (isset($_GET['id'])) {
                                    echo $id = $_GET['id'];
                                  }
                                  $sql = "SELECT * FROM tbldoctor WHERE status='1'";
                                  $query_run = mysqli_query($conn, $sql);
                                  if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                      ?>

                                      <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['name']; ?>
                                      </option>
                                      <?php
                                    }
                                  } else {
                                    ?>
                                    <option value="">No Record Found"</option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Appontment Date</label>
                                <span class="text-danger">*</span>
                                <input type="text" autocomplete="off" id="edit_date" name="scheddate" class="form-control"
                                  required onkeypress="return false;">
                              </div>
                              <div class="form-group">
                                <label>Appointment Start Time</label>
                                <span class="text-danger">*</span>
                                <div class="input-group date" id="edit_stime" data-target-input="nearest">
                                  <input type="text" autocomplete="off" name="start_time"
                                    class="form-control datetimepicker-input" required data-target="#edit_stime" />
                                  <div class="input-group-append" data-target="#edit_stime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Appointment End Time</label>
                                <span class="text-danger">*</span>
                                <div class="input-group date" id="edit_etime" data-target-input="nearest">
                                  <input type="text" autocomplete="off" name="end_time"
                                    class="form-control datetimepicker-input" required data-target="#edit_etime" />
                                  <div class="input-group-append" data-target="#edit_etime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Reason</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control" rows="2" id="edit_reason" name="reason" required
                                  placeholder="Enter ..."></textarea>
                              </div>
                              <div class="form-group">
                                <label>Status</label>
                                <span class="text-danger">*</span>
                                <select id="edit_status" name="status" class="form-control custom-select" required>
                                  <option>Pending</option>
                                  <option>Confirmed</option>
                                  <option>Treated</option>
                                  <option>No Show</option>
                                  <option>Cancelled</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="color">Color</label>
                                <span class="text-sm">(Optional)</span>
                                <select id="color" name="color" class="form-control custom-select">
                                  <option style="color:#f39c12;" value="#f39c12">Yellow</option>
                                  <option style="color:#00c0ef;" value="#00c0ef"> Aqua</option>
                                  <option style="color:#0073b7;" value="#0073b7"> Blue</option>
                                  <option style="color:#00a65a;" value="#00a65a"> Green</option>
                                  <option style="color:#FF8C00;" value="#FF8C00"> Orange</option>
                                  <option style="color:#3c8dbc;" value="#3c8dbc"> Light Blue</option>
                                  <option style="color:#f56954;" value="#f56954"> Red</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <div class="custom-control custom-checkbox" id="show-email2">
                                  <input class="custom-control-input ck" type="checkbox" id="customCheckbox3"
                                    name="send-email" disabled>
                                  <label for="customCheckbox3" class="custom-control-label">Send Email</label>
                                </div>
                              </div>

                              <?php

                            }
                          }
                        }

                        ?>
                        <div class="row">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="update_appointment1">Save
                              Changes</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
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

      $('.select2').select2()

      $(".patient").select2({
        placeholder: "Select Patient",
        allowClear: true
      });

      $(".dentist").select2({
        placeholder: "Select Dentist",
        allowClear: true
      });

      $('#edit_stime').datetimepicker({
        format: 'LT'
      });
      $('#edit_etime').datetimepicker({
        format: 'LT'
      });

      $('#edit_date').datepicker({
        todayHighlight: true,
        clearBtn: true,
        autoclose: true,
        startDate: new Date()
      });

      const colorBox = document.getElementById('color');

      colorBox.addEventListener('change', (event) => {
        const color = event.target.value;
        event.target.style.color = color;
      }, false);

      $("#edit_status").on('change', function () {
        var val = $(this).val();
        if (this.value == "Confirmed") {
          $('.ck').prop("disabled", false);
        }
        else {
          $('.ck').prop("disabled", true);
          $('#customCheckbox3').prop("checked", false);
        }
      });


      var userid = $('#edit_id').val();

      $.ajax({
        type: 'post',
        url: "calendar_action.php",
        data:
        {
          'checking_appointment': true,
          'user_id': userid,
        },
        success: function (response) {
          $.each(response, function (key, value) {
            $('#edit_date').val(value['schedule']);
            $('#edit_patient').val(value['patient_id']);
            $('#edit_patient').select2().trigger('change');
            $('#edit_doctor').val(value['doc_id']);
            $('#edit_doctor').select2().trigger('change');
            $('#edit_stime').find("input").val(value['starttime']);
            $("#edit_etime").find("input").val(value['endtime']);
            $('#edit_reason').val(value['reason']);
            $('#edit_status').val(value['status']);
            $('#color').val(value['bgcolor']);
          });
        }
      });

    });
  </script>
  <?php include('includes/footer.php'); ?>