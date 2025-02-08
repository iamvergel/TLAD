<?php
session_start();
include('config/dbconn.php');
if (!isset($_SESSION['auth'])) {
    header('Location: ../../../index.php');
    exit(0);
} else if ($_SESSION['auth_role'] == "3") {
    header('Location: ../index.php');
    exit(0);
} else if ($_SESSION['auth_role'] == "patient") {
    header('Location: ../index.php');
    exit(0);
} else if ($_SESSION['auth_role'] == "2") {
    exit(0);
} else {
}
