<?php
// index.php
include 'database_connection.php';
session_start();
$isLogin = 0;
if(isset($_SESSION['username'])) {
	$isLogin = 1;
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
			<div class="box col1">
				<div class='boxtitle'>.:: Forum Gembira ::.</div>
				<div class='boxcontent'>
				<p align='right'><a href='openthread.php'><button>Buat Thread Baru</button></a></p>
				<br><hr><br>
				<fieldset class='threadtitle'>
				<a href='thread.php?id=0'>Judul Thread</a>
				<legend class='threadstarter'>Started by <a href='profile.php?id=0'>User Ini</a></legend>
				</fieldset>
				</div>
			</div>
		</div>
		
		<div class='right'  style='height:100%;'>
			<div class="box" style='height:100%;'>
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Login Form<?php } else { ?> User Info<?php } ?></div>
				<div class='boxcontent'>
				<?php if($isLogin ==0 ) { ?>
				<form method='post' action='+login.php'>
				<fieldset class='inp-field'><legend>Username</legend>
				<input type='text' name='username' placeholder='Enter your Username'>
				</fieldset>
				<fieldset class='inp-field'><legend>Password</legend>
				<input type='text' name='password' placeholder='Enter your password'>
				</fieldset>
				<p align='right'><button type='submit' Value='Sign in'>Sign In</button></p>
				</form>
				<?php } else { ?> 
				<?php } ?>
				</div>
			</div>
			<div class="box">
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Register Form<?php } else { ?> User Info<?php } ?></div>
				<div class='boxcontent'>
				<?php if($isLogin ==0 ) { ?>
				<form method='post' action='?act=register'>
				<fieldset class='inp-field'><legend>Nickname</legend>
				<input type='text' name='username' placeholder='Enter your Nickname'>
				</fieldset>
				<fieldset class='inp-field'><legend>Username</legend>
				<input type='text' name='username' placeholder='Enter your Username'>
				<small>*only containing non capital and number</small>
				</fieldset>
				<fieldset class='inp-field'><legend>Password</legend>
				<input type='password' name='password' placeholder='Enter your password'>
				</fieldset>
				<fieldset class='inp-field'><legend>Confirm Password</legend>
				<input type='password' name='password' placeholder='Confirm your password'>
				</fieldset>
				<p align='right'><button type='submit' Value='Sign Up'>Sign Up</button></p>
				</form>
				<?php } else { ?> 
				<?php } ?>
				</div>
			</div>
		</div>
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