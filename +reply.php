<?php
session_start();
include "database_connection.php";
if(!isset($_SESSION['username'])) {
	header("location:index.php");
}
if(isset( $_POST['thread'] )) {
	$thread = $_POST['thread'];
	$uplink = $_SESSION['username'];
	$id_post = $_POST['id_post'];
	$tf = time();
	$q = $connect->prepare("INSERT INTO reply VALUES('','$uplink','$thread','$tf','$id_post','0')");
	$coba = $q->execute();
	if($coba)
		echo "<script>alert('Berhasil submit reply!');window.top.location='thread.php?id=".$id_post."';</script>";
}
