<?php
// index.php
include 'database_connection.php';
session_start();
$isLogin = 0;
if(isset($_SESSION['username'])) {
	$isLogin = 1;
	$username = $_SESSION['username'];
	$hasil = $connect->prepare("SELECT * FROM member_login WHERE username='$username'");
	$hasil->execute();
	$hasil = $hasil->fetchAll()[0];
}
if(isset($_GET['out'])) {
	session_destroy();
	die('<script>window.location="index.php";</script>');
}
if(!isset($_GET['id'])) {
	die('<script>window.location="index.php";</script>');
}	
?>
<html>
<head>
	<title>.:: Forum Gembira ::.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="style.css">
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
					
					?>
					<div class='boxtitle'><?php echo $getThread['title']; ?> - Started by : <a href='profile.php?user=<?php echo $getThread['uplink']; ?>'><?php echo $getThread['uplink']; ?></a></div>
					<div class='boxcontent'>
					<?php
					if($getThread['banned'] == 0 ) {
						echo $getThread['konten']; 
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
						if($getThread['uplink'] == $_SESSION['username'] || $hasil['level'] == "Admin") {
							echo "<hr><br>";
							if($hasil['level'] == "Admin") {
							?>
							<a href='banThread.php?id=<?php echo $id; ?>&act=0'><button>unBan This Thread</button></a>
							<?php
							}
						}
					}
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
				$data_reply = $connect->prepare("SELECT * FROM reply WHERE id_post='$id' LIMIT $halaman_awal, $batas");
				$data_reply->execute();
				$data_reply=$data_reply->fetchAll();
				for($i = 0; $i<count($data_reply); $i++) { 
				$tstamp = $data_reply[$i]['timestamp'];
				$dt = new DateTime("@$tstamp");
				
				?>
				<div class='box'>
				<div class='boxtitle'>Reply by @<?php echo $hrep[$i]['uplink']; ?> - <?php echo $dt->format('Y-m-d H:i:s'); ?></div>
				<div class='boxcontent'>
				<?php
				if($hrep[$i]['banned'] == 0) {
				echo $hrep[$i]['konten'];
				}
				else
					echo "<i>this reply has been removed/banned</i>";
				?>
				<?php
				if($hrep[$i]['banned'] == 0) {
					if($hrep[$i]['uplink'] == $_SESSION['username'] || $hasil['level'] == "Admin") {
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
				else {
					if($hasil['level'] == "Admin") {
						echo "<br><hr>";
						?><br>
						<a href='banReply.php?id=<?php echo $hrep[$i]['id_reply']; ?>&act=0&post=<?php echo $id;?>'><button>unBan This Reply</button></a>
						<?php
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
	</div>
	<br><br><br>
	<a href='#' class='tooltip' id='goTop'>
	&#x25B2;
	<div class='top'>
	go to top
    </div>
	</a>
	<div class='footer'>
	<div class='footerContent'>
	<a href='#' onclick='return false();'>&copy; Asiap Princess @2021</a>
	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js'></script>
	<script>
		(function($){

		$(document).ready(function(){
		
			$.jGrowl.defaults.closer = true;

			$.jGrowl.defaults.animateOpen = {
				opacity: 'show'
			};
			$.jGrowl.defaults.animateClose = {
				opacity: 'hide'
			};

			var msg = "<strong><b>Halo, welcome to our PA</b></strong>";
			$.jGrowl(msg, { header: 'wellcome',sticky: true });
			
			msg = "Ahmad Ridwani Hakim - <small>1915016024</small><br>Daffa Mafazi - <small>1915016040</small>";
			$.jGrowl(msg, { header: "our team",sticky: true });
			
			
		});
	})(jQuery);

	</script>

</body>
</html>