		<div class='right'>
			<div class="box" style='height:100%;'>
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Login Form<?php } else { ?> User Info<?php } ?></div>
				<div class='boxcontent'>
				<?php if($isLogin ==0 ) { ?>
				<form method='post' action='+login.php'>
				<fieldset class='inp-field'><legend>Username</legend>
				<input type='text' name='username' placeholder='Enter your Username'>
				</fieldset>
				<fieldset class='inp-field'><legend>Password</legend>
				<input type='password' name='password' placeholder='Enter your password'>
				</fieldset>
				<p align='right'><button type='submit' Value='Sign in'>Sign In</button></p>
				</form>
				<?php } else { ?> 
				Username : 
				<?php echo $_SESSION['username']; ?><br>
				Status : Online
				<?php } ?>
				</div>
			</div>
			<div class="box">
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Register Form<?php } else { ?> User Panel<?php } ?></div>
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
				<a href='profile.php?user=<?php echo $username; ?>'><button class='colmax'>My Profile</button></a>
				<a href='?out'> <button class='colmax'>Sign Out</button></a>
				<?php } ?>
				</div>
			</div>
		</div>
