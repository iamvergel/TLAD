<?php
include('../../authentication.php');
include('../../includes/header.php');
include('../../includes/topbar.php');
include('../../includes/sidebar.php');
include('../../config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="modal fade" id="editPasswordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="admin_id" id="password_edit_id">
              <h6 class="py-3">Change Password : <strong id="admin_name"></strong></h6>
              <div class="row">
                <div class="form-group col-md-6 position-relative">
                  <label>New Password</label>
                  <input type="password" autocomplete="new-password" name="new_password" id="new_password"
                    class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, at least one special character, and at least 8 or more characters"
                    required>
                  <i class="fa fa-eye" id="toggleNewPassword"
                    style="cursor: pointer; position: absolute; top: 8px; right: 10px;"></i>
                  <div class="show_hide" style="display:none;">
                    <small>Password Strength: <span id="result"> </span></small>
                  </div>
                </div>
                <div class="form-group col-md-6 position-relative">
                  <label>Confirm Password</label>
                  <input type="password" autocomplete="new-password" name="confirm_password" class="form-control"
                    id="confirm_password" required>
                </div>
              </div>
              <script>
                const toggleNewPassword = document.querySelector('#toggleNewPassword');
                const newPassword = document.querySelector('#new_password');
                toggleNewPassword.addEventListener('click', function () {
                  const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                  newPassword.setAttribute('type', type);
                  this.classList.toggle('fa-eye-slash');
                });

                function validateNewPassword() {
                  if (newPassword.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords do not match");
                  } else {
                    confirmPassword.setCustomValidity('');
                  }
                }

                newPassword.onchange = validateNewPassword;
                confirmPassword.onkeyup = validateNewPassword;
              </script>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
              <button type="submit" name="update_password" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="AddAdminModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
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
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Unit Section Head Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Division Head Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="divisionHead" class="form-control text-capitalize" required>
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
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group position-relative">
                    <label>Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="password" name="password" class="form-control"
                      pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters and one special character"
                      required>
                    <i class="fa fa-eye" id="togglePassword"
                      style="cursor: pointer; position: absolute; top: 8px; right: 10px;"></i>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <span class="text-danger">*</span>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                  </div>
                </div>
              </div>

              <script>
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');
                togglePassword.addEventListener('click', function (e) {
                  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                  password.setAttribute('type', type);
                  this.classList.toggle('fa-eye-slash');
                });
              </script>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="doc_image">Upload Image</label>
                    <input type="file" name="doc_image" id="doc_image">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="submit_button" name="insertadmin" class="btn btn-success">Submit</button>
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
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Admin Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="admin_action.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <input type="hidden" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label>Full Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="fname" id="edit_fname" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Unit Section Head Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="address" id="edit_address" class="form-control text-capitalize" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Division Head Name</label>
                    <span class="text-danger">*</span>
                    <input type="text" name="divisionHead" id="edit_Head" class="form-control text-capitalize" required>
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
                <input type="hidden" id="edit_password" name="edit_password" class="form-control" required>
                <input type="hidden" id="edit_confirmPassword" name="edit_confirmPassword" class="form-control"
                  required>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="doc_image">Upload Image</label>
                    <input type="file" id="edit_docimage" name="edit_docimage" />
                    <input type="hidden" name="old_image" id="old_image" />
                    <div id="uploaded_image"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
              <button type="submit" name="updateadmin" class="btn btn-success">Submit</button>
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

          <form action="admin_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_id" id="delete_id">
              <p> Do you want to delete this data?</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" name="deletedata" class="btn btn-danger ">Submit</button>
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
              <h1>Admin</h1>
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
                  <h3 class="card-title">Admin List</h3>
                  <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#AddAdminModal">
                    <i class="fa fa-plus"></i> &nbsp;&nbsp;Add Admin</button>
                </div>
                <div class="card-body">
                  <table id="admin_table" class="table table-borderless table-hover" style="width:100%;">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">Photo</th>
                        <th class="export">Name</th>
                        <th class="export">Unit Section Head Name</th>
                        <th class="export">Division Head Name</th>
                        <th class="export">Contact No.</th>
                        <th class="export">Email</th>
                        <th class="export" width="5%">Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $user = $_SESSION['auth_user']['user_id'];
                      $sql = "SELECT * FROM tbladmin WHERE id != '$user'";
                      $query_run = mysqli_query($conn, $sql);

                      while ($row = mysqli_fetch_array($query_run)) { ?>
                        <tr>
                          <td style="text-align: center;" width="10%"><img
                              src="../../../upload/admin/<?= $row['image'] ?>" class="img-thumbnail img-circle" width="50"
                              alt=""></td>
                          <td class="text-capitalize"><?php echo $row['name']; ?></td>
                          <td class="text-capitalize"><?php echo $row['address']; ?></td>
                          <td class="text-capitalize"><?php echo $row['division_head_name']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php
                          if ($row['status'] == 1) {
                            echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-primary activatebtn">Active</button>';
                          } else {
                            echo '<button data-id="' . $row['id'] . '" data-status="' . $row['status'] . '" class="btn btn-sm btn-danger activatebtn">Inactive</button>';
                          }
                          ?>
                          </td>
                          <td>
                            <button title="Edit Admin" data-id="<?php echo $row['id']; ?>"
                              class="btn btn-sm btn-info editAdminbtn"><i class="fas fa-edit"></i></button>
                            <button title="Change Password" data-id="<?php echo $row['id']; ?>"
                              class="btn btn-sm btn-primary editPasswordbtn"><i class="fas fa-lock"></i></button>
                            <input type="hidden" name="del_image" value="<?php echo $row['image']; ?>">
                            <button title="Delete Admin" data-id="<?php echo $row['id']; ?>"
                              class="btn btn-danger btn-sm deleteAdminbtn"><i class="far fa-trash-alt"></i></button>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th class="search">Name</th>
                        <th class="search">Unit Section Head Name</th>
                        <th class="search">Division Head Name</th>
                        <th class="search">Contact No.</th>
                        <th class="search">Email</th>
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
            columns: '.export'
          }
        },
        {
          extend: 'print',
          className: 'btn btn-outline-secondary btn-sm',
          text: '<i class="fas fa-print"></i>  Print',
          exportOptions: {
            columns: '.export'
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
          url: 'admin_action.php',
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

      //Admin Edit Modal
      $(document).on('click', '.editAdminbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "admin_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#edit_id').val(value['id']);
              $('#edit_fname').val(value['name']);
              $('#edit_address').val(value['address']);
              $('#edit_Head').val(value['division_head_name']);
              $('#edit_phone').val(value['phone'].substring(3));
              $('#edit_email').val(value['email']);
              $('#uploaded_image').html('<img src="../../../upload/admin/' + value['image'] + '" class="img-fluid img-thumbnail" width="120" />');
              $('#old_image').val(value['image']);
              $('#edit_password').val(value['password']);
              $('#edit_confirmPassword').val(value['password']);
            });

            $('#EditAdminModal').modal('show');
          }
        });
      });

      //Admin Edit Password Modal
      $(document).on('click', '.editPasswordbtn', function () {
        var userid = $(this).data('id');

        $.ajax({
          type: "POST",
          url: "admin_action.php",
          data: {
            'checking_editAdminbtn': true,
            'user_id': userid,
          },
          success: function (response) {
            $.each(response, function (key, value) {
              $('#password_edit_id').val(value['id']);
              $('#admin_name').text(value['name']);
            });

            $('#editPasswordModal').modal('show');
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
            url: "admin_action.php",
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

      $(document).on('click', '#close', function () {
        $('#EditAdminModal').modal('hide');
      });
    });
  </script>


  <?php include('../../includes/footer.php'); ?>