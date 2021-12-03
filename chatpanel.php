<?php
// index.php
include 'header.php';
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
				<iframe style='border:0; width:100%; height:300px;' src='sendpc.php?id=<?php echo $id; ?>'></iframe>
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
<?php include "footer.php"; ?>
