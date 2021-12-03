<?php
include "database_connection.php";
if(isset($_POST['username'])) {
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$nickname = trim($_POST["nickname"]);
	$check_query = "
	SELECT * FROM member_login 
	WHERE username = :username
	";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':username'		=>	$username
	);
	$message='';
	if($statement->execute($check_data))	
	{
		if($statement->rowCount() > 0)
		{
			$message .= 'Username already taken';
		}
		else
		{
			if(empty($username))
			{
				$message .= 'Username is required\n';
			}
			if(empty($password))
			{
				$message .= 'Password is required\n';
			}
			else
			{
				if($password != $_POST['confirm_password'])
				{
					$message .= 'Password not match';
				}
			}
			if($message == '')
			{
				$today = date("Y-m-d");
				$password = password_hash($password, PASSWORD_DEFAULT);
				$query = "INSERT INTO member_login VALUES('','$username','$password','$nickname','normal','$today','Member')";
				$statement = $connect->prepare($query);
				if($statement->execute())
				{
					$message = "Registration Completed";
				}
			}
		}
	}
#	echo $message;
	echo "<script>alert('$message');window.location='index.php';</script>";
}