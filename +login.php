<?php
include_once 'database_connection.php';
if(!isset($_SESSION)) {
	session_start();
}
if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}

if(isset($_POST['username']))
{
	$query = "
		SELECT * FROM member_login 
  		WHERE username = :username
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':username' => $_POST["username"]
		)
	);	
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if(password_verify($_POST["password"], $row["password"]))
			{
				if($row['status'] == "banned")
					die("<script>alert('your account has been banned by administrator. contact admin or just create new account');window.location='index.php';</script>");
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
				INSERT INTO member_login_details 
	     		(user_id) 
	     		VALUES ('".$row['user_id']."')
				";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();
				$_SESSION['level'] = $statement->fetchAll()[0]['level'];
				header('location:index.php');
			}
			else
			{
				$message = '<script>alert("Invalid username/password");window.location="index.php";</script>';
			}
		}
	}
	else
	{
		$message = '<script>alert("Invalid username/password");window.location="index.php";</script>';
	}
	echo $message;
}
