<?//Удаление Постов
$massageDel = $_GET['textDel'];
$nameUserDel = $_GET['nameDel'];
     $mysqli = new mysqli ("localhost", "root", "", "GuestBook");
     $mysqli->query("SET CHARSET 'utf8'");
     $q = "DELETE FROM Users 
	  WHERE
	  Text = '$massageDel' AND
      Users = '$nameUserDel'";
     $success = $mysqli->query("$q");
?>
