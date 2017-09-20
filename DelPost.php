<?//Удаление Постов
$massageDel = $_GET['textDel'];
$nameUserDel = $_GET['nameDel'];

//Редактирование постов

echo "<div style='width:300px; height:300px; border-style:groove;'>";
echo '<form method="post" action="#">';
echo 'Уверены что хотите удалить элемент?';
echo '<br>';
echo "Пользователь: <input type='text' name='delUser' value='$nameUserDel'>";
echo "Сообщение: <input type='text' name='delMess' value='$massageDel'>";
echo '<br>';
echo '<a href="index.php">Назад</a>';
echo '<br>';
echo '<input type="submit" value="УДАЛИТЬ">  </form> </div>';
echo '</form>';
echo "</div>";

$massage = $_POST['delMess'];
$nameUser = $_POST['delUser']; 

$mysqli = new mysqli ("localhost","root","","GuestBook");
	
$mysqli -> query ("SET CHARSET 'utf8'");
$q = "DELETE FROM Users 
	  WHERE
	  Text = '$massage' AND
      Users = '$nameUser'";
     $success = $mysqli -> query ("$q");
?>
