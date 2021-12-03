<?php
// index.php
include 'header.php';
?>
	<div class="wrapper-flex">
		<div class='left'>
			<div class="box" style='height:100%;'>
				<div class='boxtitle'>Forum Gembira :: FKTI GEMBIRA</div>
				<div class="box">
					<?php
					if(!isset($_GET['id'])) 
						echo "<scritp>window.location='index.php';</script>";
					$id = $_GET['id'];
					$getThread = $connect->prepare("SELECT * FROM `post` WHERE id_post='$id'");
					$getThread->execute();
					$getThread = $getThread->fetchAll()[0];
					$tstamp = $getThread['timestamp'];
					$dt = new DateTime("@$tstamp");
					?>
					<div class='boxtitle'><?php echo $getThread['title']; ?> - Started by <a href='profile.php?id=<?php echo get_user_id($getThread['uplink'],$connect); ?>'>@<?php echo $getThread['uplink']; ?></a> - <?php echo $dt->format('Y-m-d H:i:s'); ?></div>
					<div class='boxcontent'>
					<?php
					if($getThread['banned'] == 0 ) {
						echo $getThread['konten']; 
						if(isset($_SESSION['username'])) {
							if($getThread['uplink'] == $_SESSION['username'] || $hasil['level'] == "Admin") {
								echo "<hr><br>";
								if($hasil['level'] == "Admin") {
								?>
								<a href='banThread.php?id=<?php echo $id; ?>&act=1'><button>Ban This Thread</button></a>
								<?php
								}
								else {
								?>
								<a href='banThread.php?id=<?php echo $id; ?>&act=1'><button>Remove This Thread</button></a>
								<?php
								}
							}
						} else {
							echo "<i>this post has been removed/banned</i>";
							if(isset($_SESSION['username'])) {
								if($getThread['uplink'] == $_SESSION['username'] || $hasil['level'] == "Admin") {
									echo "<hr><br>";
									if($hasil['level'] == "Admin") {
									?>
									<a href='banThread.php?id=<?php echo $id; ?>&act=0'><button>unBan This Thread</button></a>
									<?php
									}
								}
							}
						}
					}
					else
						echo "<i>this thread has been removed/banned</i>";
					?>
					<br><br>
					</div>
				</div>
					
				<div class='box'>
				<div class='boxtitle'>Reply this thread</div>
				<div class='boxcontent'>
				<?php
				if(!isset($_SESSION['username'])) {
					echo ("Login first to reply this post");
				}
				else if($getThread['banned'] == 1) {
					echo "<i>unable to reply removed/banned post</I>";
				}
				else {
				?>
				<iframe style='width:100%; height:300px; border:0;' src='ngereply.php?post=<?php echo $_GET['id']; ?>'></iframe>
				<?php } ?>
				</div>
				</div>
				
				<?php
				$rep = $connect->prepare("SELECT * FROM reply WHERE id_post='$id' ORDER BY id_reply");
				$rep->execute();
				$hrep = $rep->fetchAll();
				$batas = 5;
				$halaman = isset($_GET['page'])?(int)$_GET['page'] : 1;
				$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

				$previous = $halaman - 1;
				$next = $halaman + 1;
				
				$jumlah_data  = count($hrep);
				$totalHalaman = (int) $jumlah_data /$batas;
				$nomor = $halaman_awal+1;
				$tq = "SELECT * FROM reply WHERE id_post='$id' LIMIT $halaman_awal, $batas";
				$data_reply = $connect->prepare($tq);
				$data_reply->execute();
				$data_reply=$data_reply->fetchAll();
				for($i = 0; $i<count($data_reply); $i++) { 
				$tstamp = $data_reply[$i]['timestamp'];
				$dt = new DateTime("@$tstamp");
				
				?>
				<div class='box'>
				<div class='boxtitle'>Reply by <a href='profile.php?id=<?php echo get_user_id($data_reply[$i]['uplink'],$connect); ?>'>@<?php echo $data_reply[$i]['uplink']; ?></a> - <?php echo $dt->format('Y-m-d H:i:s'); ?></div>
				<div class='boxcontent'>
				<?php
				if($data_reply[$i]['banned'] == 0) {
				echo $data_reply[$i]['konten'];
				}
				else
					echo "<i>this reply has been removed/banned</i>";
				?>
				<?php
				if($data_reply[$i]['banned'] == 0) {
					if(isset($_SESSION['username'])) {
						if($data_reply[$i]['uplink'] == $_SESSION['username'] || $hasil['level'] == "Admin") {
							echo "<br><hr>";
							?><br>
							<?php
							if($hasil['level'] == "Admin") { ?>
							<a href='banReply.php?id=<?php echo $hrep[$i]['id_reply']; ?>&act=1&post=<?php echo $id;?>'><button>Ban This Reply</button></a>
							<?php } else { ?>
							<a href='banReply.php?id=<?php echo $hrep[$i]['id_reply']; ?>&act=1&post=<?php echo $id;?>'><button>Remove This Reply</button></a>
							<?php } 
						}
					}
				}
				else {
					if(isset($_SESSION['username'])) {
						if($hasil['level'] == "Admin") {
							echo "<br><hr>";
							?><br>
							<a href='banReply.php?id=<?php echo $hrep[$i]['id_reply']; ?>&act=0&post=<?php echo $id;?>'><button>unBan This Reply</button></a>
							<?php
						}
					}
				}					
				?>
				</div>
				</div>
				<?php } ?><br>
				<center>
				Page
				<?php 
				for($x=1;$x<=$totalHalaman+1;$x++){
					?> 
					<a class="page-link" href="?page=<?php echo $x ?>&id=<?php echo$id; ?>"><?php echo $x; ?></a> &nbsp;
					<?php
				}
				?>
				</center>
				<br><br><br>
			</div>
		</div>
	<?php include "rightbar.php"; ?>
<?php include "footer.php"; ?>
