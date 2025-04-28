<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "tala";

// $sname = "database-1.ctaowmq2kfea.ap-southeast-2.rds.amazonaws.com";
// $uname = "admin";
// $password = "CIH0qrwpNwceRdQ6cY2i";
// $db_name = "tala";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
  header("Location: ../errors/db.php");
  die();
}
