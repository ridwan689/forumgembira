<?php
session_start();
include 'database_connection.php';
if(!isset($_SESSION['user_id'])) {
	echo( "<script>alert('silahkan login dulu');window.location='index.php';</script>");
}

$isLogin = 0;
if(isset($_SESSION['user_id'])) {
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
	<link rel="stylesheet" href="texting.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
				<div class='boxtitle'>.:: Open Thread ::.</div>
				<div class='boxcontent'>
				<div class="form-group">
					<div class="chat_message_area">
					<div hidden='hidden' id='imgtemp' style='display:none;'>
					</div>
						<div id="chat_message_area" style='min-height:300px; padding:5px;' contenteditable>
						</div>
						<div class="image_upload">
							<form id="uploadImage" method="post" action="upload.php">
								<label for="uploadFile"><img src="upload.png" /></label>
								<input type="file" name="uploadFile" onchange="" id="uploadFile" accept=".jpg, .png" />
							</form>
						</div>
					</div>
				</div>
				<div class="form-group" align="right">
					<button type="button" name="send_group_chat" id="send_post" class="btn btn-info">Send</button>
				</div>
				
				</div>
			</div>
		</div>
		
		<div class='right'  style='height:100%;'>
			<div class="box" style='height:100%;'>
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Login Form<?php } else { ?> User Info<?php } ?></div>
				<div class='boxcontent'>
				<?php if($isLogin ==0 ) { ?>
				<form method='post' action='?act=login'>
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
	<script src='sc.js'></scripT>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
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