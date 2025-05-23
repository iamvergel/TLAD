<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item mt-2">
      <p><span>
          <?php
          include_once('../admin/config/dbconn.php');

          // Check if user is logged in
          if (isset($_SESSION['auth'])) {
            // Using prepared statements to prevent SQL injection
            $sql = "
            SELECT 
                tblcoordinator.*, 
                department.name AS department_name, 
                unit.unit_name AS unit_name
            FROM tblcoordinator
            LEFT JOIN department ON tblcoordinator.division_id = department.id
            LEFT JOIN unit ON tblcoordinator.unit_id = unit.id
            WHERE tblcoordinator.id = ?
        ";
            if ($stmt = mysqli_prepare($conn, $sql)) {
              mysqli_stmt_bind_param($stmt, "i", $_SESSION['auth_user']['user_id']);

              mysqli_stmt_execute($stmt);

              $result = mysqli_stmt_get_result($stmt);

              while ($row = mysqli_fetch_array($result)) {
                ?>
                <span class="d-none d-md-inline text-uppercase" style="font-weight: bold; font-size: 20px;">
                  <?= $row['department_name'] ?> / <?= $row['unit_name'] ?>
                </span>
                <?php
              }
              mysqli_stmt_close($stmt);
            }
          } else {
            echo "Not Logged in";
          }
          ?>
        </span>
      </p>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span><?php
        include_once('../admin/config/dbconn.php');
        if (isset($_SESSION['auth'])) {
          $sql = "SELECT * FROM tblcoordinator WHERE id = '" . $_SESSION['auth_user']['user_id'] . "'";
          $query_run = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($query_run)) {
            echo '<img src="../upload/coordinators/' . $row['image'] . '" class="user-image img-circle elevation-2" alt="Staff Image">';
            ?>
              <span class="d-none d-md-inline">
                <?= $row['name'] ?>
              </span>
            <?php }
        } else {
          echo "Not Logged in";
        }

        ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="profile.php" class="dropdown-item">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item logoutbtn">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>