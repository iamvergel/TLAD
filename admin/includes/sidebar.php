<aside class="main-sidebar sidebar-light-success elevation-3">

  <a href="../../../index.php" class="brand-link">
    <img src="../../../upload/<?= $system_logo ?>" alt="image" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-normal text-lg text-dark"><?= $system_name ?></span>
  </a>
  <?php $page = basename(dirname($_SERVER['PHP_SELF'])); ?>
  <div class="sidebar">
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
            <i class="fa fa-home nav-icon"></i>
            <p>Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../admins" class="nav-link <?= $page == 'admins' ? 'active' : '' ?>">
            <i class="fas fa-user-shield nav-icon"></i>
            <p>Admins </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../coordinator" class="nav-link <?= $page == 'coordinator' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-nurse"></i>
            <p>Coordinators</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../employees" class="nav-link <?= $page == 'employees' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Employees</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../report section" class="nav-link <?= $page == 'report section' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Report Section</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../inactive_employees" class="nav-link <?= $page == 'inactive_employees' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-slash"></i>
            <p>Inactive Employees</p>
          </a>
        </li>
        <li class="nav-item <?= $page == 'department' || $page == 'unit' || $page == 'system' ? 'menu-open' : '' ?>">
          <a href="#"
            class="nav-link <?= $page == 'department' || $page == 'unit' || $page == 'system' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-globe"></i>
            <p>System</p>
            <i class="fas fa-angle-left right "></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../system" class="nav-link <?= $page == 'system' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>System Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../department" class="nav-link <?= $page == 'department' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../unit" class="nav-link <?= $page == 'unit' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Units</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>