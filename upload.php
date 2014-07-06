<?php 
//get unique id
$up_id = uniqid(); 
$success = 0;
?>

<?php

//process the forms and upload the files
if ($_POST) {

//specify folder for file upload
$folder = "tmp/"; 

//specify redirect URL
$redirect = "upload.php?success";

//upload the file
for($i = 0; $i < count($_FILES["file"]["name"]); $i++)
{
    move_uploaded_file($_FILES["file"]["tmp_name"][$i], $folder.$_FILES["file"]["name"][$i]);
}

//do whatever else needs to be done (insert information into database, etc...)

//redirect user
//	header('Location: '.$redirect); die();
$success = 1;
}
//

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload your file</title>


<link href="style_progress.css?v=28" rel="stylesheet" type="text/css" />



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.js" type="text/javascript"></script>


<script>

$(document).ready(function() { 



	var show_bar = 0;
    $('input[type="file"]').click(function(){
		show_bar = 1;
    });


    $("#form1").submit(function(){

		if (show_bar === 1) { 
			$('#upload_frame').show();
			function set () {
				$('#upload_frame').attr('src','upload_frame.php?up_id=<?php echo $up_id; ?>');
			}
			setTimeout(set);
		}
    });


});

</script>

</head>


<body>

<div id="header">


<h1>Загрузите свой файл </h1>



  <?php if ($success) { ?>
  <span class="notice">Ваш файл был успешно загружен. </span>
  <?php } ?>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <br />
    <br />
    Выберите файлы для загрузки<br />


    <input type="hidden" name="APC_UPLOAD_PROGRESS" id="progress_key" value="<?php echo $up_id; ?>"/>


    <input name="file[]" type="file" multiple id="file" size="30"/>


    <br />
    <iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no"  > </iframe>
    <br />


    <input name="Submit" type="submit" id="submit" value="Submit" />
  </form>
  </div>


</div>
</body>

</html>
