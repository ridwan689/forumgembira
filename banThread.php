<?php
include "database_connection.php";
if(isset($_GET['id']) && isset($_GET['act'])) {
	$act = $_GET['act'];
	$id=$_GET['id'];
	$q = $connect->prepare("UPDATE post SET banned='$act' WHERE id_post='$id'");
	$q->execute();
	echo "<script>window.location='thread.php?id=$id';</script>";
}
?>
	