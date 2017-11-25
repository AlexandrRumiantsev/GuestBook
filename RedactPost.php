<body>

<div>
<? 
//Редактирование постов
$massage = $_GET['oldText'];
$nameUser = $_GET['nameUpp'];
$newMassage = $_GET['textUpp'];
$time = $_GET['times'];

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