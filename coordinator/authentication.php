<?php
session_start();
include('../admin/config/dbconn.php');
if(!isset($_SESSION['auth']))
{   
    header('Location: ../index.php');
    exit(0);
}
else if($_SESSION['auth_role'] == "patient")
{
    header('Location: ../index.php');
    exit(0);
}
else if($_SESSION['auth_role'] == "2")
{
    header('Location: ../index.php');
    exit(0);
}
else if($_SESSION['auth_role'] == "admin")
{
    header('Location: ../index.php');
    exit(0);
}
else
{
    
}
