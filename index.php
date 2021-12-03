<?php
// index.php
session_start();
include 'database_connection.php';
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
?>
<html>
<head>
	<title>.:: Forum Gembira ::.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="chatbox.css">
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
				$uplink = $data_thread[$i]['uplink'];
				?>
				<fieldset class='threadtitle'>
				<a href='thread.php?id=<?php echo $id; ?>'><?php echo $judul; ?></a>
				<legend class='threadstarter'>Started by <a href='profile.php?user=<?php echo $uplink; ?>'><?php echo $uplink; ?></a></legend>
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