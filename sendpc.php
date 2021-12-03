<link rel="stylesheet" href="style.css">
<form method='post'>
<input type='text' name='chat_message' style='width:100%;'>
<button type='submit'>Send Message</button>
</form>
<?php
include "database_connection.php";
session_start();
if(isset($_GET['id']) && isset($_POST['chat_message'])) {
	$data = array(
		':to_user_id'		=>	$_GET['id'],
		':from_user_id'		=>	$_SESSION['user_id'],
		':chat_message'		=>	$_POST['chat_message'],
		':status'			=>	'1'
	);

	$query = "
	INSERT INTO chat_message 
	(to_user_id, from_user_id, chat_message, status) 
	VALUES (:to_user_id, :from_user_id, :chat_message, :status)
	";

	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
	}
}
?>
