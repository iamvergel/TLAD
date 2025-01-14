<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "tala";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
  header("Location: ../errors/db.php");
  die();
}
