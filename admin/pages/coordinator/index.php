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

  function loadUnitsForDepartmentedit() {
    var departmentId = $('#editdepartment_id').val();

    if (departmentId) {
      $('#editunit_id').html('<option value="">Loading...</option>');

      $.ajax({
        url: 'fetch_units.php',
        type: 'GET',
        data: { department_id: departmentId },
        success: function (response) {
          try {
            var units = JSON.parse(response);
            var unitSelect = $('#editunit_id');

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
          $('#editunit_id').html('<option value="">Select Unit</option>');
        }
      });
    } else {
      $('#editunit_id').html('<option value="">Select Unit</option>');
    }
  }
</script>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="AddAdminModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Coordinator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="coordinator_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <!-- Existing Fields -->
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 d-none">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" class="form-control text-capitalize" >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" class="form-control js-phone" name="phone" pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input id="email" type="email" name="email" pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$"
                      class="form-control" required />
                  </div>
                </div>
              </div>

              <!-- Department and Unit Dropdowns -->
              <div class="row">
                <div class="col-sm-6">
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
                        echo "<option value=''>No Division available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit</label><span class="text-danger">*</span>
                    <select id="unit_id" name="unit_id" class="form-control" required>
                      <option value="">Select Unit</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- New Fields for Section Head and Division -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Name</label><span class="text-danger">*</span>
                    <input type="text" name="unit_section_head_name" class="form-control text-capitalize" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Title</label><span class="text-danger">*</span>
                    <input type="text" name="unit_section_head_title" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Name</label><span class="text-danger">*</span>
                    <input type="text" name="division_head_name" class="form-control text-capitalize" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Position</label><span class="text-danger">*</span>
                    <input type="text" name="division_head_position" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>

              <!-- Password Fields -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group position-relative">
                    <label>Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="password" name="password" class="form-control"
                      pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters and one special character"
                      required>
                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; top: 8px; right: 10px;"></i>
                  </div>
                </div>
                <script>
                  const togglePassword = document.querySelector('#togglePassword');
                  const password = document.querySelector('#password');
                  togglePassword.addEventListener('click', function (e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    // toggle the eye slash icon
                    this.classList.toggle('fa-eye-slash');
                  });
                </script>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                  </div>
                </div>
              </div>

              <!-- Image Upload -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="coor_image">Upload Image</label>
                    <input type="file" name="coor_image" id="coor_image">
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_button" name="insertcoordinator" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="ViewAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Admin Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="admin_viewing_data">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="EditAdminModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Coordinator Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="coordinator_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" id="edit_fname" class="form-control text-capitalize"
                      required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 d-none">
                  <div class="form-group">
                    <label>Address</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" id="edit_address" class="form-control" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <span class="text-danger">*</span>
                    <input type="text" id="edit_phone" name="phone" class="form-control js-phone"
                      pattern="^(09|\+639)\d{9}$" required>
                  </div>
                </div>
                <div class="col-sm-6 auto">
                  <div class="form-group">
                    <label>Email</label>
                    <span class="text-danger">*</span>
                    <input type="email" name="email" id="edit_email" class="form-control email_id"
                      pattern="^[-+.\w]{1,64}@[-.\w]{1,64}\.[-.\w]{2,6}$" class="form-control" required>
                    <span class="email_error text-danger"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="editdepartment_id" name="department_id">
                <input type="hidden" id="editunit_id" name="unit_id">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division</label><span class="text-danger">*</span>
                    <select id="edit_department_id" class="form-control"  required disabled>
                      <option value="">Select Division</option>
                      <?php

                      $sql = "SELECT * FROM department";
                      $query_run = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No Division available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit</label><span class="text-danger">*</span>
                    <select id="edit_unit_id" class="form-control"  required disabled>
                      <option value="">Select Unit</option>
                      <?php
                      $sql = "SELECT * FROM unit";
                      $query_run = mysqli_query($conn, $sql);

                      if (mysqli_num_rows($query_run) > 0) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                          echo "<option value='" . $row['id'] . "'>" . $row['unit_name'] . "</option>";
                        }
                      } else {
                        echo "<option value=''>No units available</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <!-- New Fields for Section Head and Division -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Name</label><span class="text-danger">*</span>
                    <input type="text" name="unit_section_head_name" id="edit_unit_section_head_name"
                      class="form-control text-capitalize" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Unit Section Head Title</label><span class="text-danger">*</span>
                    <input type="text" name="unit_section_head_title" id="edit_unit_section_head_title"
                      class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Name</label><span class="text-danger">*</span>
                    <input type="text" name="division_head_name" id="edit_division_head_name" class="form-control text-capitalize"
                      required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Division Head Position</label><span class="text-danger">*</span>
                    <input type="text" name="division_head_position" id="edit_division_head_position"
                      class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
                <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control"
                  required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="coor_image">Upload Image</label>
                    <input type="file" id="coor_image" name="coor_image" />
                    <input type="hidden" name="old_image" id="old_image" />
                    <div id="uploaded_image"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
              <button type="submit" name="updatecoordinator" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="DeleteAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form action="coordinator_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <p> Do you want to delete this data?</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="deletedata" class="btn btn-success ">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Coordinator</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Admin</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include('../../message.php'); ?>
              <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Coordinator List</h3>
                  <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#AddAdminModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Coordinator</button>
                </div>
                <div class="card-body">
                  <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Photo</th>
                        <th class="export">Name</th>
                        <th class="export">Email</th>
                        <th class="export">Division</th>
                        <th class="export">unit</th>
                        <th class="export" width="5%">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "
                              SELECT 
                                tblcoordinator.*, 
                                department.name AS department_name, 
                                unit.unit_name AS unit_name
                              FROM tblcoordinator
                              LEFT JOIN department ON tblcoordinator.division_id = department.id
                              LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
                            ";

                      $query_run = mysqli_query($conn, $sql);

                      if (!$query_run) {
                        die('Query Failed: ' . mysqli_error($conn));
                      }


                      while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                        <tr>
                          <td style="text-align: center;" width="10%">
                            <img src="../../../upload/coordinators/<?= $row['image'] ?>" class="img-thumbnail img-circle"
                              width="50" alt="">
                          </td>
                          <td class="text-capitalize"><?php echo $row['name']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['department_name']; ?></td>
                          <td><?php echo $row['unit_name']; ?></td>
                          <td>
                            <?php
                            if ($row['status'] == 1) {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-success activatebtn">Active</button>';
                            } else {
                              echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                            }
                            ?>
                          </td>
                          <td>
                            <button data-id="<?php echo $row['id']; ?>" class="btn btn-sm btn-info editAdminbtn">
                              <i class="fas fa-edit"></i>
                            </button>
                            <!-- <button data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deleteAdminbtn">
                              <i class="far fa-trash-alt"></i>
                            </button> -->
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th class="search">Name</th>
                        <th class="search">Email</th>
                        <th class="search">Division</th>
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
      $('#admin_table tfoot th.search').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" class="search-input form-control form-control-sm"/>');
      });
      var table = $('#admin_table').DataTable({
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
            columns: '.export'
          }
        },
        {
          extend: 'csvHtml5',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="far fa-file-csv"></i>  CSV',
          exportOptions: {
            columns: '.export'
          }
        },
        {
          extend: 'excel',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="far fa-file-excel"></i>  Excel',
          exportOptions: {
            columns: '.export'
          }
        },
        {
            extend: 'pdfHtml5',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="far fa-file-pdf"></i>  PDF',
            exportOptions: {
              modifier: {
                page: 'current',
                search: 'none'
              },
              columns: '.export'
            },
            customize: function (doc) {
              doc.content.splice(0, 0, {
                image: 'data:image/jpeg;base64,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',
                width: 550,
                height: 70,
                alignment: 'center',
                margin: [0, 0, 0, 20]
              });

              doc.content.push({
                text: 'Date: ' + new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }),
                marginTop: 25,
                fontSize: 12,
                alignment: 'left'
              });

              doc.pageMargins = [40, 60, 40, 60]; // Ensure space at the bottom for footer
              doc.content.push({
                text: [
                  '______________________________________________________________________________________________________________________________________\nAddress: St. Joseph Avenue, Tala, Caloocan City, 1427 ● Trunkline: 8294-2571 to 73 ● Telefax: 8962-8209 ● Philhealth Accredited\nISO 9001:2015 Certified ● Email Address: djnrmh2003@yahoo.com ● URL: http://djnrmh.doh.gov.ph'
                ],
                fontSize: 8,
                alignment: 'center',
                marginTop: 50
              });

            }
          },
          {
            extend: 'print',
            className: 'btn btn-outline-secondary btn-sm',
            text: '<i class="fas fa-print"></i>  Print',
            title: '',
            messageTop: '<div class="d-flex justify-content-center align-items-center mb-5"><img src="../../assets/image/header.jpg" alt="Header Image" style="width: 100%;"/></div>',
            messageBottom: '',
            exportOptions: {
              modifier: {
                page: 'current',
                search: 'none'
              },
              columns: '.export'
            },
            action: function (e, dt, button, config) {
                const currentDate = new Date().toLocaleDateString('en-US', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric'
                });

                config.messageBottom = `
                    <div style="text-align: start;">
                        <p style="margin-bottom: 5rem;">Date: ${currentDate}</p>
                        <hr>
                        <div style="width: 100%; text-align: center; font-size: 10px;">
                          <p>Address: St. Joseph Avenue, Tala, Caloocan City, 1427 Trunkline: 8294-2571 to 73 | Telefax: 8962-8209 Philhealth Accredited ISO 9001:2015 Certified</p>
                          <p>Email Address: djnrmh2003@yahoo.com URL: <a href="http://djnrmh.doh.g">http://djnrmh.doh.g</a></p>
                        </div>
                    </div>
                `;
              $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
          }
        ],
        initComplete: function () {
          // Apply the search
          this.api().columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change clear', function () {
              if (that.search() !== this.value) {
                that
                  .search(this.value)
                  .draw();
              }
            });
          });
        }
      });

      $(document).on('click', '.viewAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          url: 'coordinator_action.php',
          type: 'post',
          data: {
            'checking_viewAdmintbtn': true,
            'user_id': userid,
          },
          success: function (response) {

            $('.admin_viewing_data').html(response);
            $('#ViewAdminModal').modal('show');
          }
        });
      });

      //Admin Delete Modal
      $(document).on('click', '.deleteAdminbtn', function () {

        var user_id = $(this).data('id');
        $('#delete_id').val(user_id);
        $('#DeleteAdminModal').modal('show');
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
            url: "coordinator_action.php",
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

      //Admin Edit Modal
      $(document).on('click', '.editAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "coordinator_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['name']);
              $('#edit_address').val(value['address']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#edit_department_id').val(value['division_id']);
              $('#edit_unit_id').val(value['unit_id']);  // Set the unit_id correctly
              $('#editdepartment_id').val(value['division_id']);
              $('#editunit_id').val(value['unit_id']);

              $('#edit_unit_section_head_name').val(value['unit_section_head_name']);
              $('#edit_unit_section_head_title').val(value['unit_section_head_title']);
              $('#edit_division_head_name').val(value['division_head_name']);
              $('#edit_division_head_position').val(value['division_head_position']);
              $('#uploaded_image').html('<img src="../../../upload/coordinators/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_confirmPassword').val(value['password']);
            });

            $('#EditAdminModal').modal('show');
          }
        });
      });

      $(document).on('click', '#close', function () {
        $('#EditAdminModal').modal('hide');
      });
    });
  </script>
  <?php include('../../includes/footer.php'); ?>