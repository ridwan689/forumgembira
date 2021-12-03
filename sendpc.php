<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="style.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
  <form method='post' id='formnya'>
  <textarea id='chat_message' name='chat_message' hidden='hidden'></textarea>
  </form>
  <div id="summernote"><p></p></div>
  <script>
    $(document).ready(function() {
		$('#summernote').summernote({
			placeholder: 'Tulis pesan anda',
			tabsize: 2,
			minHeight: 150,
			maxHeight: 150
		}); 
	});
  </script>
  <p align='right'>
  <button id='submit'>Kirim Pesan</button>
  </p>
  <script>
  $(document).ready(function(){
	$("#submit").click(function () {
		var apa =  $('#summernote').summernote('code'); 
		$("#chat_message").val(apa);
		$("#formnya").submit();
	});
  });
  </script>
</body>
</html>
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
