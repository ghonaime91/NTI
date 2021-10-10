<?php
$server  = "localhost";
$db_name = "nti_course";
$db_user = "root";
$db_pass = "";

$con = mysqli_connect($server,$db_user,$db_pass,$db_name);
if(!$con) {
    echo die("Error ".mysqli_connect_error());
}

