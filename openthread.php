<?php
session_start();
include 'database_connection.php';
if(!isset($_SESSION['user_id'])) {
	echo( "<script>alert('silahkan login dulu');window.location='index.php';</script>");
}

$isLogin = 0;
if(isset($_SESSION['user_id'])) {
	$isLogin = 1;
}
if(isset($_GET['out'])) {
	session_destroy();
	die('<script>window.location="index.php";</script>');
}
?>
<html>
<head>
	<title>.:: Forum Gembira ::.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="texting.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.0/jquery.jgrowl.css">
</head>

<body>
<div id='dummyPro'></div>
	<div class='navbar'>
	<div>
	<a href='index.php'>
	Homepage
	</a>
	</div>
	<div>
	<a href='#' onclick='return false;'>
	Forum Gembira
	</a>
	</div>
	<div>
	<a href='#' onclick='return false;'>
	Praktikum Web
	</a>
	</div>
	</div>
	<div class="wrapper-flex">
		<div class='left'>
			<div class="box col1">
				<div class='boxtitle'>.:: Open Thread ::.</div>
				<div class='boxcontent'>
				<iframe src='ngepost.php' width="100%" height="600px" style='border:none;'></iframe>
				</iframe>
				</div>
			</div>
		</div>
<?php
include "rightbar.php";
include "footer.php";
?>