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
  <form method='post' id='formnya' action='+thread.php'>
  <input required='required' type='text' name='title' placeholder='Judul Thread Anda'>
  <textarea id='thread' name='thread' hidden='hidden'></textarea>
  </form>
  <div id="summernote"><p></p></div>
  <script>
    $(document).ready(function() {
		$('#summernote').summernote({
			placeholder: 'Tulis thread anda',
			tabsize: 2,
			minHeight: 400,
			maxHeight: 400
		}); 
	});
  </script>
  <p align='right'>
  <button id='submit'>Submit Thread</button>
  </p>
  <script>
  $(document).ready(function(){
	$("#submit").click(function () {
		var apa =  $('#summernote').summernote('code'); 
		$("#thread").val(apa);
		$("#formnya").submit();
	});
  });
  </script>
</body>
</html>