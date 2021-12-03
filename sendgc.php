<link rel="stylesheet" href="style.css">
<form method='post' action='?gc=post'>
<input type='text' name='chat_message' style='width:100%;'>
<button type='submit'>Send Message</button>
</form>
<?php
include "database_connection.php";
session_start();
if(isset($_GET['gc']) && isset($_POST['chat_message'])) {
	$data = array(
		':from_user_id'		=>	$_SESSION["user_id"],
		':chat_message'		=>	$_POST['chat_message'],
		':status'			=>	'1'
	);

	$query = "
	INSERT INTO chat_message 
	(from_user_id, chat_message, status) 
	VALUES (:from_user_id, :chat_message, :status)
	";

	$statement = $connect->prepare($query);

	if($statement->execute($data))
	{
	}
}
?>
