<?php 	
session_start();
include "db_conn.php";

if (isset($_POST['uemail']) && isset($_POST['password'])) {

	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	return $data;
	}

	$uemail = validate($_POST['uemail']);
	$pass = validate($_POST['password']);

	if(empty($uemail)) {
		header("Location: index.php?error=Email is required");
		exit();
	}
	else if(empty($pass)) {
		header("Location: index.php?error=Password is required");
		exit();
	}
	else {
		$sql = "SELECT * FROM users WHERE user_email='$uemail' AND password='$pass'";


		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);

			if ($row['user_email'] === $uemail && $row['password'] === $pass) {
				$_SESSION['user_email'] = $row['user_email'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				header("Location: home.php");
				exit();
			}
			else {
			header("Location: index.php?error=Incorrect Email or Password");
			exit();
			}
		}
		else {
			header("Location: index.php?error=Incorrect Email or Password");
			exit();
		}
	}
}
else {
	header("Location: index.php");
	exit();
}

 ?>