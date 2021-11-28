<?php
session_start();
include "database_connection.php";
if(!isset($_SESSION['username'])) {
	header("location:index.php");
}
if(isset( $_POST['thread'] )) {
	$thread = $_POST['thread'];
	$uplink = $_SESSION['username'];
	$title = $_POST['title'];
	$tf = time();
	$q = $connect->prepare("INSERT INTO post VALUES('','$title','$thread','$uplink','$tf')");
	$coba = $q->execute();
	if($coba)
		echo "<script>alert('Berhasil submit post!');window.top.location='index.php';</script>";
}
