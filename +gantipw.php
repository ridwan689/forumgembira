<?php
session_start();
include 'database_connection.php';
$msg = 'invalid input';
if(isset($_POST['oldpw']) && isset($_POST['newpw']) && isset($_POST['confirm_password'])) {
	$username = $_SESSION['username'];
	$olw = $_POST['oldpw'];
	$new = $_POST['newpw'];
	$hasil = $connect->prepare("SELECT * FROM member_login WHERE username='$username'");
	$hasil->execute();
	$hasil = $hasil->fetchAll()[0];
	if(password_verify($_POST["oldpw"], $hasil['password'])) {
		if($new == $_POST['confirm_password']) {
			$new = password_hash($new, PASSWORD_DEFAULT);
			$q = $connect->prepare("UPDATE member_login SET password='$new' WHERE username='$username'");
			$q->execute();
			$msg='berhasil ganti password';
		}
		else
		{
			$msg = 'konfirmasi password anda sekali lagi, pastikan password baru dan konfirmasi password sama';
		}
	}
	else {
		$msg = 'invalid old password, please try again.';
	}
}
echo "<script>alert('".$msg."'); window.location='index.php';</script>";
