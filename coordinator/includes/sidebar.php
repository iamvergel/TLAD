<aside class="main-sidebar sidebar-light-success elevation-3">
  <a href="../index.php" class="brand-link">
    <img src="../upload/<?= $system_logo ?>" alt="image" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-normal text-lg text-dark"><?= $system_name ?></span>
  </a>
  <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>
  <div class="sidebar">
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>">
            <i class="fa fa-home nav-icon "></i>
            <p>Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="employee.php" class="nav-link <?= $page == 'employee.php' ? 'active' : '' ?>">
            <i class="nav-icon fa fa-users-medical "></i>
            <p>Employees</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="report_section.php" class="nav-link <?= $page == 'report_section.php' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file"></i>
            <p>Report Section</p>
          </a>
        </li>
        <!-- <li class="nav-item <?= $page == 'appointment.php' || $page == 'calendar.php' || $page == 'online-request.php' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $page == 'appointment.php' || $page == 'calendar.php' || $page == 'online-request.php' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-calendar "></i>
            <p>
              Appointment
              <i class="fas fa-angle-left right"></i>
              <?php
              $sql = "SELECT * FROM tblappointment WHERE status='Pending'";
              $query_run = mysqli_query($conn, $sql);
              $row = mysqli_num_rows($query_run);
              if ($row > 0) {
                echo '<span class="right badge badge-danger">New</span>';
              }
              ?>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="appointment.php" class="nav-link <?= $page == 'appointment.php' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Walk In Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="online-request.php" class="nav-link <?= $page == 'online-request.php' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Online Request</p>
                <?php
                $sql = "SELECT * FROM tblappointment WHERE schedtype='Online Schedule' AND status='Pending'";
                $query_run = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($query_run);
                if ($row > 0) {
                  echo '<span class="badge badge-warning right">' . $row . '</span>';
                }
                ?>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="payments.php" class="nav-link <?= $page == 'payments.php' ? 'active' : '' ?>">
            <i class="nav-icon fab fa-cc-paypal"></i>
            <p>Payments</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="reports.php" class="nav-link <?= $page == 'reports.php' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-pdf "></i>
            <p>Reports</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?= $page == 'profile.php' ? 'active' : '' ?>">
            <i class="nav-icon fa fa-user-alt "></i>
            <p>Profile</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>