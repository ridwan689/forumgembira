<link rel="stylesheet" href="style.css">
<?php
include "database_connection.php";
if(isset($_GET['q'])) {
	$q=$_GET['q'];
	if($q=="") {
	}
	else {
		$cari = $connect->prepare("SELECT * FROM member_login WHERE username LIKE '%$q%'");
		$cari->execute();
		$cari=$cari->fetchAll();
		echo "Ditemukan : ".count($cari)." user<br><br>";
		for($i = 0; $i<count($cari); $i++) {
			$id=$cari[$i]['user_id'];
			$un=$cari[$i]['username'];
			$status=$cari[$i]['status'];
			?>
			<fieldset class='threadtitle'>
			<a href='profile.php?id=<?php echo $id; ?>'><?php echo $un; ?></a>
			
			</fieldset>
			<?php
		}
	}
}
?>