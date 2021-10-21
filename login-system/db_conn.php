<?php

$sname= "localhost";
$user_email= "root";
$password = "";

$db_name = "test_db";

$conn = mysqli_connect($sname, $user_email, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}