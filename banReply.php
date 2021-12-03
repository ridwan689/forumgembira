<?php
include "database_connection.php";
if(isset($_GET['id']) && isset($_GET['act'])) {
	$act = $_GET['act'];
	$id=$_GET['id'];
	$post=$_GET['post'];
	$q = $connect->prepare("UPDATE reply SET banned='$act' WHERE id_reply='$id'");
	$q->execute();
	echo "<script>window.location='thread.php?id=$post';</script>";
}
?>
	