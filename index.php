<?php
session_start();
include('includes/header.php');
include('admin/config/dbconn.php');
if (isset($_SESSION['auth'])) {
    if ($_SESSION['auth_role'] == "admin") {
        $_SESSION['status'] = "You are already logged in";
        header('Location: admin/pages/dashboard');
        exit(0);
    } else if ($_SESSION['auth_role'] == "coordinator") {
        $_SESSION['status'] = "You are already logged in";
        header('Location: coordinator/index.php');
        exit(0);
    } else if ($_SESSION['auth_role'] == "2") {
        $_SESSION['status'] = "You are already logged in";
        header('Location: dentist/index.php');
        exit(0);
    } else if ($_SESSION['auth_role'] == "3") {
        $_SESSION['status'] = "You are already logged in";
        header('Location: staff/index.php');
        exit(0);
    }
}
?>

<style>
    body {
        background-image: url('upload/<?= $brand ?>');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        background-color: #3A7D44;
        width: 100%;
        height: 100%;
        opacity: 0.5;
    }

    body::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        background: rgb(19, 66, 20);
        background: -moz-linear-gradient(90deg, rgba(19, 66, 20, 1) 0%, rgba(226, 204, 106, 1) 100%);
        background: -webkit-linear-gradient(90deg, rgba(19, 66, 20, 1) 0%, rgba(226, 204, 106, 1) 100%);
        background: linear-gradient(90deg, rgba(19, 66, 20, 1) 0%, rgba(226, 204, 106, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#134214", endColorstr="#e2cc6a", GradientType=1);
        width: 100%;
        height: 70%;
        opacity: 1;
        clip-path: polygon(100% 100%, 0% 100%, 0.00% 11.14%, 2.00% 10.62%, 4.00% 10.31%, 6.00% 10.21%, 8.00% 10.32%, 10.00% 10.64%, 12.00% 11.17%, 14.00% 11.90%, 16.00% 12.83%, 18.00% 13.95%, 20.00% 15.25%, 22.00% 16.72%, 24.00% 18.35%, 26.00% 20.13%, 28.00% 22.04%, 30.00% 24.08%, 32.00% 26.21%, 34.00% 28.44%, 36.00% 30.73%, 38.00% 33.07%, 40.00% 35.45%, 42.00% 37.85%, 44.00% 40.24%, 46.00% 42.61%, 48.00% 44.94%, 50.00% 47.21%, 52.00% 49.40%, 54.00% 51.51%, 56.00% 53.50%, 58.00% 55.37%, 60.00% 57.10%, 62.00% 58.68%, 64.00% 60.10%, 66.00% 61.34%, 68.00% 62.40%, 70.00% 63.26%, 72.00% 63.92%, 74.00% 64.38%, 76.00% 64.63%, 78.00% 64.67%, 80.00% 64.50%, 82.00% 64.12%, 84.00% 63.53%, 86.00% 62.75%, 88.00% 61.76%, 90.00% 60.59%, 92.00% 59.24%, 94.00% 57.72%, 96.00% 56.05%, 98.00% 54.23%, 100.00% 52.28%);
        z-index: -1;
    }

    @media (max-width: 768px) {
        body::after {
            display: none;

        }
    }
</style>


<body class="hold-transition login-page">
    <div class="d-none d-lg-block">
        <div class="d-flex" style="position: absolute; bottom: 1rem; left: 1rem">
            <img src="upload/<?= $logo1 ?>" alt="logo1" height="80" class="rounded-circle ">
            <img src="upload/<?= $logo2 ?>" alt="logo2" height="80" class="rounded-circle mx-3">
            <img src="upload/<?= $system_logo ?>" alt="logo" height="80" class="rounded-circle">
        </div>
    </div>
    <div class="d-block d-lg-none">
        <div class="d-flex" style="position: absolute; bottom: 1rem; left: 50%; transform: translate(-50%, -50%)">
            <img src="upload/<?= $logo1 ?>" alt="logo1" height="80" class="rounded-circle ">
            <img src="upload/<?= $logo2 ?>" alt="logo2" height="80" class="rounded-circle mx-3">
            <img src="upload/<?= $system_logo ?>" alt="logo" height="80" class="rounded-circle">
        </div>
    </div>
    <div class="login-box">
        <?php
        if (isset($_SESSION['auth_status'])) {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['auth_status']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <?php
            unset($_SESSION['auth_status']);
        }
        ?>
        <!-- /.login-logo -->
        <div class="card card-outline card-success shadow">
            <div class="card-body login-card-body">
                <div class="d-block d-lg-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="upload/<?= $system_logo ?>" alt="logo" height="75">
                    </div>
                    <a href="index.php">
                        <h5 class="login-box-msg text-success font-weight-bold mt-3"><?php echo $system_name ?></h5>
                    </a>
                </div>
                <p class="login-box-msg">Sign in</p>
                <?php
                include('admin/message.php');
                ?>
                <form action="logincode.php" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password"
                            required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-eye" id="eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login_btn" class="btn btn-success btn-block">Log
                            In</button>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</body>

</html>
<?php include('includes/scripts.php'); ?>