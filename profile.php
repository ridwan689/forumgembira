<?php
include "header.php";
?>
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
				<div class='boxtitle'>.:: Forum Gembira ::.</div>
				<div class='boxcontent'>
				<?php
				$id = $_GET['id'];
				$usr = $connect->prepare("SELECT * FROM member_login WHERE user_id='$id'");
				$usr->execute();
				$usr = $usr->fetchAll();
				if(count($usr) > 0) {
					$usr=$usr[0];
				?>
				<fieldset>
				<legend>
				Username
				</legend>
				<?php echo $usr['username']; ?>
				</fieldset>
				<fieldset>
				<legend>
				Level
				</legend>
				<?php echo $usr['level']; ?>
				</fieldset>

				<fieldset>
				<legend>
				Registration Date
				</legend>
				<?php echo $usr['tanggal_daftar']; ?>
				</fieldset>

				<fieldset>
				<legend>
				Status User
				</legend>
				<?php echo $usr['status']; ?>
				</fieldset>
				<fieldset>
				<legend>
				Action
				</legend>
				<?php
				if($hasil['level'] == "Admin" && $usr['user_id'] !== $_SESSION['user_id']) {
				?>
				<?php 
				if($usr['status'] == "normal") {
				?>
				<a href='banUser.php?id=<?php echo $usr['user_id'];?>&act=banned'><button>Ban</button></a>
				<?php
				}
				else {
				?>
				<a href='banUser.php?id=<?php echo $usr['user_id'];?>&act=normal'><button>Unban</button></a>
				<?php
				}
				?>
				<?php } ?>
				<?php if($usr['user_id'] !== $_SESSION['user_id']) { ?>
				<a href='chatpanel.php?id=<?php echo $usr['user_id']; ?>'><button>Start Chat</button></a>
				<?php } else { ?>
				<fieldset>
				<legend>Ganti Password</legend>
				<form method='post' action='+gantipw.php'>
				<fieldset class='inp-field'><legend>Old Password</legend>
				<input type='password' name='oldpw' placeholder='Enter your old password'>
				</fieldset>
				<fieldset class='inp-field'><legend>New Password</legend>
				<input type='password' name='newpw' placeholder='Enter your new password'>
				</fieldset>
				<fieldset class='inp-field'><legend>Confirm Password</legend>
				<input type='password' name='confirm_password' placeholder='Confirm your password'>
				</fieldset>
				<p align='right'><button type='submit'>Reset Password</button></p>
				</form>
				
				</fieldset>
				<?php } ?>
				</fieldset>

				<?php } else { echo "Invalid user id"; } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	<?php include "rightbar.php"; ?>
<?php include "footer.php"; ?>
