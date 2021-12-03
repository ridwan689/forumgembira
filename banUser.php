<?php
include "database_connection.php";
if(isset($_GET['id']) && isset($_GET['act'])) {
	$act = $_GET['act'];
	$id=$_GET['id'];
	$q = $connect->prepare("UPDATE member_login SET status='$act' WHERE user_id='$id'");
	$q->execute();
	echo "<script>window.location='profile.php?id=$id';</script>";
}
?>
	