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
            <i class="fas fa-users nav-icon"></i>
            <p>Admins </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="../dentists" class="nav-link <?= $page == 'dentists' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-user-md"></i>
            <p>Dentists</p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="../coordinator" class="nav-link <?= $page == 'coordinator' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Coordinators</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../employees" class="nav-link <?= $page == 'employees' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Employee</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../report section" class="nav-link <?= $page == 'report section' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file"></i>
            <p>Report Section</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../inactive_employees" class="nav-link <?= $page == 'inactive_employees' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-times"></i>
            <p>Inactive Employees</p>
          </a>
        </li>
        <li
          class="nav-item <?= $page == 'highlight' || $page == 'about' || $page == 'services' || $page == 'services_patient' || $page == 'mail' || $page == 'procedure-offers' || $page == 'sms' || $page == 'payment-settings' || $page == 'health-declaration' || $page == 'reviews' || $page == 'gallery' || $page == 'featured' || $page == 'system' ? 'menu-open' : '' ?>">
          <a href="#"
            class="nav-link <?= $page == 'highlight' || $page == 'about' || $page == 'services' || $page == 'services_patient' || $page == 'mail' || $page == 'procedure-offers' || $page == 'sms' || $page == 'payment-settings' || $page == 'health-declaration' || $page == 'reviews' || $page == 'gallery' || $page == 'featured' || $page == 'system' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-globe"></i>
            <p>Website</p>
            <i class="fas fa-angle-left right "></i>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="../highlight" class="nav-link <?= $page == 'highlight' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Highlight Content</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../about" class="nav-link <?= $page == 'about' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>About Us</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../services" class="nav-link <?= $page == 'services' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../services_patient" class="nav-link <?= $page == 'services_patient' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Services Patient</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../procedure-offers" class="nav-link <?= $page == 'procedure-offers' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Procedure Offers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../health-declaration" class="nav-link <?= $page == 'health-declaration' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Questionnaire</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../reviews" class="nav-link <?= $page == 'reviews' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Review</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../gallery" class="nav-link <?= $page == 'gallery' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../featured" class="nav-link <?= $page == 'featured' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Featured Dentist</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../mail" class="nav-link <?= $page == 'mail' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Email Settings</p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a href="../payment-settings" class="nav-link <?= $page == 'payment-settings' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Settings</p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a href="../sms" class="nav-link <?= $page == 'sms' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>SMS Settings</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="../system" class="nav-link <?= $page == 'system' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Website Settings</p>
              </a>
            </li>
          </ul>
        </li>
        <li
          class="nav-item <?= $page == 'department' || $page == 'unit'  ? 'menu-open' : '' ?>">
          <a href="#"
            class="nav-link <?= $page == 'department' || $page == 'unit'  ? 'active' : '' ?>">
            <i class="nav-icon fas fa-globe"></i>
            <p>System</p>
            <i class="fas fa-angle-left right "></i>
          </a>
          <ul class="nav nav-treeview">
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
        <!-- <li class="nav-item">
          <a href="../backup" class="nav-link <?= $page == 'backup' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-server"></i>
            <p>Backup Database</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../reports" class="nav-link <?= $page == 'reports' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-pdf "></i>
            <p>Reports</p>
          </a>
        </li> -->
      </ul>
    </nav>
  </div>
</aside>