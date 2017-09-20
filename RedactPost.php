<body>

<div>
<? 
//Редактирование постов
$massage = $_GET['text'];
$nameUser = $_GET['name'];
echo "<div style='width:300px; height:300px; border-style:groove;'>";
echo "Редактирование сообщения пользователя $nameUser";
echo '<form method="post" action="#">';
echo '<br>';
echo "<input type='text' name='uppmass' value='$massage'>";
echo '<br>';
echo '<a href="index.php">Назад</a>';
echo '<br>';
echo '<input type="submit" value="Save">  </form> </div>';
echo '</form>';
echo "</div>";

//Апгрэйд текста в БД

$newMassage = $_POST['uppmass'];

$mysqli = new mysqli ("localhost","root","","GuestBook");
	
      $mysqli -> query ("SET CHARSET 'utf8'");
	 $q = "UPDATE Users 
	       SET
		   Text = '$newMassage'
		   WHERE Users = '$nameUser'";
     $success = $mysqli -> query ("$q");
	 $massage = $newMassage;
    

?>
</div>
</body>