<?php
// index.php
include 'header.php';
?>
	<div class="wrapper-flex">
		<div class='left'>
			<div class='box'>
			<div class='boxtitle'>Search Thread</div>
			<div class='boxcontent'>
			<form method='post' action='?search'>
			<input type='text' name='query' id='searchthread' style='width:100%;' placeholder='Keyword'>
			</form>
			<div id='hasilsearch'>
			</div>
			<script>
			$( "#searchthread" ).keyup(function() {
				var q = $("#searchthread").val();
				var c = "+searchthread.php?q="+q;
				$("#hasilsearch").html("Please wait...");
				$("#hasilsearch").load(c);
			});
			</script>
			</div>
			</div>
			<div class="box col1">
				<div class='boxtitle'>.:: Forum Gembira ::.</div>
				<div class='boxcontent'>
				<p align='right'><a href='openthread.php'><button>Buat Thread Baru</button></a></p>
				<br><hr><br>
				<?php
				$qT = $connect->prepare("SELECT * FROM post ORDER BY id_post DESC");
				$qT->execute();
				$thread = $qT->fetchAll();
				$batas = 10;
				$halaman = isset($_GET['page'])?(int)$_GET['page'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

				$previous = $halaman - 1;
				$next = $halaman + 1;
				
				$jumlah_data  = count($thread);
				$totalHalaman = (int) $jumlah_data /$batas;
				$nomor = $halaman_awal+1;
				$data_thread = $connect->prepare("SELECT * FROM post ORDER BY id_post DESC LIMIT $halaman_awal, $batas");
				$data_thread->execute();
				$data_thread = $data_thread->fetchAll();
				for($i=0; $i<count($data_thread); $i++) {
				$id = $data_thread[$i]['id_post'];
				$judul = $data_thread[$i]['title'];
				$upid = get_user_id($data_thread[$i]['uplink'], $connect);
				$uplink = $data_thread[$i]['uplink'];
				?>
				<fieldset class='threadtitle'>
				<a href='thread.php?id=<?php echo $id; ?>'><?php echo $judul; ?></a>
				<legend class='threadstarter'>Started by <a href='profile.php?id=<?php echo $upid; ?>'><?php echo $uplink; ?></a></legend>
				</fieldset>
				<?php } ?>
				<center>
				Page
				<?php 
				for($x=1;$x<=$totalHalaman+1;$x++){
					?> 
					<a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a> &nbsp;
					<?php
				}
				?>
				</center>
				</div>
			</div>
		</div>
	<?php include "rightbar.php"; ?>
<?php include "footer.php"; ?>
