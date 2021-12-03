		<div class='right'>
			<div class="box" style='height:100%;'>
				<div class='boxtitle'><?php if($isLogin ==0 ) { ?>Login Form<?php } else { ?> User Info<?php } ?></div>
				<div class='boxcontent'>
				<?php if($isLogin ==0 ) { ?>
				<form method='post' action='+login.php'>
				<fieldset class='inp-field'><legend>Username</legend>
				<input type='text' name='username'onkeypress="allowAlphaNumericSpace(event)" placeholder='Enter your Username'>
				</fieldset>
				<fieldset class='inp-field'><legend>Password</legend>
				<input type='password'onkeypress="allowAlphaNumericSpace(event)" name='password' placeholder='Enter your password'>
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
				<form method='post' action='+register.php'>
				<fieldset class='inp-field'><legend>Nickname</legend>
				<input type='text' name='nickname' placeholder='Enter your Nickname'>
				</fieldset>
				<fieldset class='inp-field'><legend>Username</legend>
				<input type='text' name='username'onkeypress="allowAlphaNumericSpace(event)" placeholder='Enter your Username'>
				<small>*only containing non capital and number</small>
				</fieldset>
				<fieldset class='inp-field'><legend>Password</legend>
				<input type='password' name='password'onkeypress="allowAlphaNumericSpace(event)" placeholder='Enter your password'>
				</fieldset>
				<fieldset class='inp-field'><legend>Confirm Password</legend>
				<input type='password' name='confirm_password'onkeypress="allowAlphaNumericSpace(event)" placeholder='Confirm your password'>
				</fieldset>
				<p align='right'><button type='submit' Value='Sign Up'>Sign Up</button></p>
				</form>
				<?php } else { ?>
				<a href='profile.php'><button class='colmax'>Search Profile</button></a>
				<a href='profile.php?id=<?php echo $_SESSION['user_id']; ?>'><button class='colmax'>My Profile</button></a>
				<a href='chatpanel.php'> <button class='colmax'>Chat Panel</button></a>
				<a href='?out'> <button class='colmax'>Sign Out</button></a>
				<?php } ?>
				</div>
			</div>
			<div class='box' style='max-height:600px;'>
			<div class='boxtitle'>Global Chat</div>
			<div class='boxcontent'>
			<?php if(isset($_SESSION['username'])) { ?>
			<iframe style='width:100%; height:auto; border:0;' src='sendgc.php'></iframe>
			<?php } ?>
			<iframe  style='width:100%; height:400px; border:0;' src='globalchat.php'></iframe>
			</div>
			</div>
		</div>
