<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
include('payment_config.php');
?>


<!-- Modal -->
<div class="modal fade" id="appointment-summary-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Appointment Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- summary will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmBtn">Confirm Appointment</button>
            </div>
        </div>
    </div>
</div>

<!-- Notification for verification -->
<div class="modal fade" id="successModal" tabindex="1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="successModalLabel">Appointment Confirmed</h5>
            </div>
            <div class="modal-body" id="modalMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.reload();">Okay</button>
            </div>
        </div>
    </div>
</div>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
            </div>

            <style>
                .select2-container .select2-selection--single,
                .select2-container--default .select2-selection--single .select2-selection__arrow {
                    height: 100% !important;
                }

                .select2-selection__choice {
                    color: #444 !important;
                    background: transparent !important;
                }
            </style>

            <div class="content">
                <div class="container-fluid">
                    <form id="appointment_request" method="post">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="text-primary">Set an Appointment</h3>
                                        <hr>
                                        <div class="callout callout-danger">
                                            <p class="h5">Note: After clicking request appointment button it will direct
                                                to
                                                <span class="text-primary">Paypal</span>. You can only refund your
                                                appointment fee in our clinic. This feature is to protect the site from
                                                spammer.
                                            </p>
                                        </div>
                                        <p class="text-justify text-muted">Due to COVID-19 pandemic we are strictly by
                                            appointment only until further notice.
                                            Please do not schedule an appointment if you have signs or symptoms of
                                            COVID-19.
                                            Wearing a face mask is a must to ensure the safety of Doctors and
                                            Patients.We will confirm your appointment via email or call 2 to 3 days
                                            before your appointment date.
                                        </p>
                                        <p class="text-justify text-muted">This questionnaire is designed with your
                                            safety in mind and must be answered honestly. Your answers will be reviewed
                                            prior to your appointment and a member of our team will contact you if we
                                            recommend rescheduling to a later date. An answer of YES does not exclude
                                            you from treatment. Please answer YES or NO to each of the following
                                            questions. Thank you for your consideration and understanding.</p>
                                        <input type="hidden" name="userid"
                                            value="<?php echo $_SESSION['auth_user']['user_id']; ?>">
                                        <div class="row col-12">
                                            <?php
                                            if (isset($_SESSION['auth'])) {
                                                $sql = "SELECT * FROM tblpatient WHERE id = '" . $_SESSION['auth_user']['user_id'] . "'";
                                                $query_run = mysqli_query($conn, $sql);

                                                $row = mysqli_fetch_assoc($query_run);

                                                if ($row) {
                                                    $dob = new DateTime($row['dob']);
                                                    $currentDate = new DateTime();
                                                    $age = $currentDate->diff($dob)->y;
                                                    ?>
                                                    <div class="form-group col-md-4">
                                                        <label>Name</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control name" name="name" id="userName"
                                                            style="width: 100%;"
                                                            value="<?= $row['fname'] . ' ' . $row['lname'] ?>" readonly
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Address</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control address" name="address"
                                                            id="Address" style="width: 100%;" value="<?= $row['address'] ?>"
                                                            readonly required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Phone</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control phone" name="phone" id="Phone"
                                                            style="width: 100%;" value="<?= $row['phone'] ?>" readonly required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Age</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control dob" name="dob" id="dob"
                                                            style="width: 100%;" value="<?= $age ?>" readonly required>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <div class="form-group col-md-4">
                                                <label>Occupation</label><span class="text-danger">*</span>
                                                <input type="text" class="form-control occupation" name="occupation"
                                                    id="occupation" style="width: 100%;" value="" required>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Personal Status</label><span class="text-danger">*</span>
                                                <select class="form-control personal_status" name="personal_status"
                                                    id="personal_status" style="width: 100%;" required>
                                                    <option value="" disabled selected>Select Status</option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                    <option value="widowed">Widowed</option>
                                                    <option value="separated">Separated</option>
                                                    <option value="engaged">Engaged</option>
                                                    <option value="in_a_relationship">In a Relationship</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Complain</label><span class="text-danger">*</span>
                                                <textarea class="form-control complain" name="complain" id="complain"
                                                    rows="5" style="resize: none; overflow: auto;" required></textarea>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Preferred Dentist</label>
                                                <span class="text-danger">*</span>
                                                <select class="form-control select2 dentist" name="preferredDentist"
                                                    id="preferredDentist" style="width: 100%;" required>
                                                    <option selected disabled value="">Preferred Doctor</option>
                                                    <?php
                                                    if (isset($_GET['id'])) {
                                                        echo $id = $_GET['id'];
                                                    }
                                                    $sql = "SELECT * FROM tbldoctor WHERE status='1' ORDER BY name ASC";
                                                    $query_run = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        foreach ($query_run as $row) {
                                                            ?>

                                                            <option value="<?php echo $row['id']; ?>">
                                                                <?php echo $row['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Available Date</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="preferredDate"
                                                    id="preferredDate" style="width: 100%;" required>
                                                    <option selected disabled value="">Preferred Date</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Available Time</label><span class="text-danger">*</span>
                                                <select class="form-control select2" name="preferredTime"
                                                    id="preferredTime" style="width: 100%;" required>
                                                    <option selected disabled value="">Preferred Time</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 form-group">
                                            <label>Service</label><span class="text-danger">*</span>
                                            <select class="select2" multiple="multiple" name="service[]" id="service"
                                                data-placeholder="Services" style="width: 100%;" required>
                                                <?php
                                                $sql = "SELECT * FROM procedures ORDER BY procedures ASC";
                                                $query_run = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['procedures']; ?>"
                                                            data-price="<?php echo $row['price']; ?>">
                                                            <?php echo $row['procedures']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Health Declaration
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $sql = "SELECT * FROM questionnaires";
                                        $query_run = mysqli_query($conn, $sql);
                                        $check_services = mysqli_num_rows($query_run) > 0;

                                        if ($check_services) {
                                            while ($row = mysqli_fetch_array($query_run)) {
                                                ?>
                                                <div class="form-group">
                                                    <label for="" name="qid[<?php echo $row['id'] ?>]"><?= $row['questions'] ?>
                                                        *</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ans[<?php echo $row['id'] ?>" value="Yes" required>
                                                        <label class="form-check-label">Yes</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ans[<?php echo $row['id'] ?>" value="No" required>
                                                        <label class="form-check-label" value="No">No</label>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "<h5> No Record Found</h5>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="insertdata" value="1">
                                <input type="hidden" name="totalAmount" id="totalAmount" value="">
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <button type="button" id="request-appointment" class="btn btn-primary">Request
                                            Appointment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

        <?php include('includes/scripts.php'); ?>
        <script>
            $(document).ready(function () {
                // Function to initialize Select2 with custom settings
                function initializeSelect2(id, placeholder, allowClear = true, ajaxSettings = null) {
                    var select2Config = {
                        placeholder: placeholder,
                        allowClear: allowClear,
                    };

                    if (ajaxSettings) {
                        select2Config.ajax = ajaxSettings;
                    }

                    $(id).select2(select2Config);
                }

                // Initialize Select2 for each element with custom settings
                initializeSelect2('.select2', 'Select an option');
                initializeSelect2('.dentist', 'Select Dentist');
                initializeSelect2('#preferredDate', 'Available Date');
                initializeSelect2('#service', 'Services');
                initializeSelect2('#preferredTime', 'Available Time');

                $("#preferredDentist").on("change", function () {
                    var selectedDentistId = $("#preferredDentist").val();
                    $('#preferredDate').val('');
                    $('#preferredTime').val(null).trigger('change');

                    initializeSelect2('#preferredDate', 'Available Date', true, {
                        url: 'request_action.php',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                doctorIdDate: selectedDentistId,
                                patientId: <?php echo $_SESSION['auth_user']['user_id']; ?>
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true,
                    });

                    $('#preferredDate').on('change', function (e) {
                        $("#service").val(null).trigger("change");
                        var data = $(this).select2('data')[0] ?? '';
                        var infoValue = data.info ?? '';
                        console.log(infoValue);

                        initializeSelect2('#service', 'Select Service');
                    });
                });

                $("#preferredDate").on("change", function () {
                    var selectedSchedId = $("#preferredDate").val();
                    $('#preferredTime').val('');

                    initializeSelect2('#preferredTime', 'Available Time', true, {
                        url: 'request_action.php',
                        type: 'POST',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                selectedDateId: selectedSchedId,
                            };
                        },
                        processResults: function (response) {
                            return {
                                results: response
                            };
                        },
                        cache: true,
                    });
                });

                $('#request-appointment').on('click', function () {
                    var services = [];
                    var totalAmount = 0;

                    // Get selected services and calculate total amount
                    $('#service').select2('data').forEach(function (service) {
                        services.push({
                            name: service.text,
                            price: $(service.element).data('price')
                        });
                        totalAmount += $(service.element).data('price');
                    });

                    $('#totalAmount').val(totalAmount);

                    var doctor = $('#preferredDentist').select2('data')[0].text;
                    var date = $('#preferredDate').select2('data')[0].text;
                    var time = $('#preferredTime').select2('data')[0].text;
                    var complain = $('#complain').val();

                    var modalContent = `
        <table class="table table-bordered">
            <tr>
                <th>Doctor:</th>
                <td>${doctor}</td>
            </tr>
            <tr>
                <th>Date:</th>
                <td>${date}</td>
            </tr>
            <tr>
                <th>Time:</th>
                <td>${time}</td>
            </tr>
            <tr>
                <th>Services:</th>
                <td>
                    <ul>
                        ${services.map(function (service) {
                        return `<li>${service.name} - <span class="float-right">₱ ${service.price}</span></li>`;
                    }).join('')}
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Total Amount:</th>
                <td><strong class="float-right">₱ ${totalAmount}</strong></td>
            </tr>
            <tr>
                <th>Complain:</th>
                <td>${complain}</td> <!-- Display the complain text here -->
            </tr>
        </table>
    `;

                    $('#modal-body').html(modalContent);
                    $('#appointment-summary-modal').modal('show');
                });


                $('#confirmBtn').on('click', function () {
                    var formData = $('#appointment_request').serialize(); // Serialize the entire form

                    $.ajax({
                        url: 'request_action.php',
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            var res = JSON.parse(response);

                            if (res.status == 'success') {
                                $('#appointment-summary-modal').modal('hide');

                                document.getElementById("modalMessage").innerText = res.message;

                                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                successModal.show();
                            } else {
                                alert('Error confirming appointment: ' + res.message);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                            alert('Error confirming appointment: ' + textStatus + ' ' + errorThrown);
                        }
                    });
                });

            });
        </script>

        <?php include('includes/footer.php'); ?>