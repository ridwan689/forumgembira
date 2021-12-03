<?php
session_start();
include "database_connection.php";
echo fetch_user_chat_history($_SESSION['user_id'], $_GET['id'], $connect);
?>
