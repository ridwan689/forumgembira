<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=forum_gembira;charset=utf8mb4", "root", "");

date_default_timezone_set('Asia/Makassar');
function get_user_name($user_id, $connect)
{
	$query = "SELECT username FROM member_login WHERE user_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['username'];
	}
}
function get_user_id($username, $connect)
{
	$query = "SELECT user_id FROM member_login WHERE username = '$username'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_id'];
	}
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
		if($row["from_user_id"] == $from_user_id)
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			}
			else
			{
				$chat_message = $row['chat_message'];
				$user_name = '<b class="text-success">You</b>';
			}
			

			$dynamic_background = 'background-color:#ffe6e6;';
		}
		else
		{
			if($row["status"] == '2')
			{
				$chat_message = '<em>This message has been removed</em>';
			}
			else
			{
				$chat_message = $row["chat_message"];
			}
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}
		$output .= '
		<div style="border-bottom:1px dotted #ccc;padding-top:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.'
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</div>
		';
	}
	$output .= '</ul>';
	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;
}


function fetch_group_chat_history($connect)
{
	$query = "
	SELECT * FROM chat_message 
	WHERE to_user_id = '0'  
	ORDER BY timestamp DESC
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		$dynamic_background = '';
		$chat_message = '';
				$chat_message = $row["chat_message"];
			$user_name = '<b class="text-danger">@'.get_user_name($row['from_user_id'], $connect).'</b>';
			$dynamic_background = 'background-color:#ffffe6;';

		$output .= '

		<div style="border-bottom:1px dotted #ccc;padding-top:8px; padding-right:8px;'.$dynamic_background.'">
			<p>'.$user_name.' - '.$chat_message.' 
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</div>
		';
	}	
	$output .= '</ul>';
	return $output;
}


?>