<body>

<div>
<? 
//Редактирование постов
$massage = $_POST['oldText'];
$nameUser = $_POST['nameUpp'];
$newMassage = $_POST['textUpp'];
$time = $_POST['times'];
$mysqli = new mysqli ("localhost","root","","GuestBook");
      $mysqli -> query ("SET CHARSET 'utf8'");
	 $q = "UPDATE Users 
	       SET
		   Text = '$newMassage'
		   WHERE Users='$nameUser' and Text='$massage'";
     $success = $mysqli -> query ("$q");
	 $massage = $newMassage;
?>
</div>
</body>