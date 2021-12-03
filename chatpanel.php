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
?>
<html>
<head>
	<title>.:: Forum Gembira ::.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
			<div class='boxtitle'>Search User</div>
			<div class='boxcontent'>
			<form method='post' action='?search'>
			<input type='text' name='query' id='searchthread' style='width:100%;' placeholder='Keyword'>
			</form>
			<div id='hasilsearch'>
			</div>
			<script>
			$( "#searchthread" ).keyup(function() {
				var q = $("#searchthread").val();
				var c = "+searchuser.php?q="+q;
				$("#hasilsearch").html("Please wait...");
				$("#hasilsearch").load(c);
			});
			</script>
			</div>
			</div>
			<?php if(isset($_GET['id'])) { ?>
			<div class="box col1">
				<div class='boxtitle'>Chat Panel - Chat w/ @<?php echo get_user_name($_GET['id'], $connect); ?></div>
				<div class='boxcontent'>
				<?php
				$id = $_GET['id'];
				$usr = $connect->prepare("SELECT * FROM member_login WHERE user_id='$id'");
				$usr->execute();
				$usr = $usr->fetchAll();
				if(count($usr) > 0) {
					$usr=$usr[0];
				?>
				<iframe style='border:0; width:100%; height:100px;' src='sendpc.php?id=<?php echo $id; ?>'></iframe>
				<div id='chatarea' class='chatarea'>Please wait...</div>
				<input type='text' id='chatwith' hidden='hidden' value='<?php echo $id; ?>'>
				<script>
				var target = $("#chatwith").val();
				$("#chatarea").load("pc.php?id="+target);
				setInterval(function(){
					$("#chatarea").load("pc.php?id="+target);
				}, 4000);
				</script>
				<?php } else { echo "Invalid user id"; } ?>
				</div>
			</div>
			<?php } ?>
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