<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
session_start();
include "database_connection.php";
echo fetch_group_chat_history($connect);
?>