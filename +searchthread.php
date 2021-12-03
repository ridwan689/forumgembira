<link rel="stylesheet" href="style.css">
<?php
include "database_connection.php";
if(isset($_GET['q'])) {
	$q=$_GET['q'];
	if($q=="") {
	}
	else {
		$cari = $connect->prepare("SELECT * FROM post WHERE title LIKE '%$q%'");
		$cari->execute();
		$cari=$cari->fetchAll();
		echo "Ditemukan : ".count($cari)." judul<br><br>";
		for($i = 0; $i<count($cari); $i++) {
			$id=$cari[$i]['id_post'];
			$judul=$cari[$i]['title'];
			$uplink=$cari[$i]['uplink'];
			?>
			<fieldset class='threadtitle'>
				<a href='thread.php?id=<?php echo $id; ?>'><?php echo $judul; ?></a>
				<legend class='threadstarter'>Started by <a href='profile.php?user=<?php echo $uplink; ?>'><?php echo $uplink; ?></a></legend>
			</fieldset>
			<?php
		}
	}
}
?>