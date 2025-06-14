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
                        <div class="col-sm-6">
                            <h1>Settings</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            include('../../message.php');
                            ?>
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">System Information</h3>
                                </div>
                                <form action="settings_action.php" method="post" enctype="multipart/form-data"
                                    onsubmit="return validateForm();">
                                    <div class="card-body">
                                        <?php
                                        $sql = "SELECT * FROM system_details WHERE id='1' LIMIT 1";
                                        $result = mysqli_query($conn, $sql);

                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <div class="row">
                                                <div class="form-group col-md-6 d-none">
                                                    <label>Opening Hours</label>
                                                    <span class="text-danger">*</span><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="mon" name="day[]"
                                                            type="checkbox" value="1" <?php echo isset($row['days']) && in_array("1", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Monday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="tue" name="day[]"
                                                            type="checkbox" value="2" <?php echo isset($row['days']) && in_array("2", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Tuesday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="wed" name="day[]"
                                                            type="checkbox" value="3" <?php echo isset($row['days']) && in_array("3", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Wednesday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="thur" name="day[]"
                                                            type="checkbox" value="4" <?php echo isset($row['days']) && in_array("4", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Thursday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="fri" name="day[]"
                                                            type="checkbox" value="5" <?php echo isset($row['days']) && in_array("5", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Friday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="sat" name="day[]"
                                                            type="checkbox" value="6" <?php echo isset($row['days']) && in_array("6", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Saturday</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="sun" name="day[]"
                                                            type="checkbox" value="7" <?php echo isset($row['days']) && in_array("7", explode(",", $row['days'])) ? "checked" : '' ?>>
                                                        <label class="form-check-label">Sunday</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 d-none">
                                                    <label>Opening Hours</label>
                                                    <span class="text-danger">*</span>
                                                    <div class="input-group date" id="open_hours"
                                                        data-target-input="nearest">
                                                        <input type="text" autocomplete="off" name="opening_hours"
                                                            value="<?= $row['openhr'] ?>"
                                                            class="form-control datetimepicker-input" required
                                                            data-target="#open_hours" />
                                                        <div class="input-group-append" data-target="#open_hours"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 d-none">
                                                    <label for="">Closing Hours</label>
                                                    <span class="text-danger">*</span>
                                                    <div class="input-group date" id="close_hours"
                                                        data-target-input="nearest">
                                                        <input type="text" autocomplete="off" name="closing_hours"
                                                            value="<?= $row['closehr'] ?>"
                                                            class="form-control datetimepicker-input" required
                                                            data-target="#close_hours" />
                                                        <div class="input-group-append" data-target="#close_hours"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">System Name</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?= $row['name'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Address</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="address" class="form-control"
                                                        value="<?= $row['address'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Telephone No.</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="telephone" class="form-control"
                                                        value="<?= $row['telno'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Email</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="email" name="email" class="form-control"
                                                        value="<?= $row['email'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Contact Number</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="tel" id="phone" class="form-control js-phone"
                                                        value="<?= substr($row['mobile'], 3) ?>" name="mobile"
                                                        pattern="^(09|\+639)\d{9}$" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Facebook Link</label>
                                                    <input type="text" name="fblink" class="form-control"
                                                        value="<?= $row['facebook'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-6 d-none">
                                                    <label for="">Google Map Address</label>
                                                    <input type="text" name="map" class="form-control"
                                                        value="<?= $row['map'] ?>" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">System Logo</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="file" name="img_url" placeholder="">
                                                    <input type="hidden" name="old_image" value="<?= $row['logo'] ?>" />
                                                    <span class="direct-chat-timestamp text-sm">Recommended Size :
                                                        180x180</span>
                                                    <div id="uploaded_image">
                                                        <img src="../../../upload/<?= $row['logo'] ?>"
                                                            class="img-thumbnail img-fluid" width="120" alt="Icon Image">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Background</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="file" name="img_brand" placeholder="">
                                                    <input type="hidden" name="old_image_brand"
                                                        value="<?= $row['brand'] ?>" />
                                                    <span class="direct-chat-timestamp text-sm">Recommended Size :
                                                        200x100</span>
                                                    <div id="uploaded_image">
                                                        <img src="../../../upload/<?= $row['brand'] ?>"
                                                            class="img-thumbnail img-fluid" width="200" alt="Brand Image">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="">Logo 1</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="file" name="logo1" placeholder="">
                                                    <input type="hidden" name="old_image_logo1"
                                                        value="<?= $row['logo1'] ?>" />
                                                    <span class="direct-chat-timestamp text-sm">Recommended Size :
                                                        200x100</span>
                                                    <div id="uploaded_image">
                                                        <img src="../../../upload/<?= $row['logo1'] ?>"
                                                            class="img-thumbnail img-fluid" width="200" alt="Logo1 Image">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="">Logo 2</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="file" name="logo2" placeholder="">
                                                    <input type="hidden" name="old_image_logo2"
                                                        value="<?= $row['logo2'] ?>" />
                                                    <span class="direct-chat-timestamp text-sm">Recommended Size :
                                                        200x100</span>
                                                    <div id="uploaded_image">
                                                        <img src="../../../upload/<?= $row['logo2'] ?>"
                                                            class="img-thumbnail img-fluid" width="200" alt="Logo2 Image">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <button type="submit" name="system_details" class="btn btn-success float-right"
                                                    onClick="return checkForm(this);">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../../includes/scripts.php'); ?>
        <script>
            var checkboxes = $('.form-check-input');
            checkboxes.change(function () {
                if ($('.form-check-input:checked').length > 0) {
                    checkboxes.removeAttr('required');
                } else {
                    checkboxes.attr('required', 'required');
                }
            });
        </script>
        <?php include('../../includes/footer.php'); ?>