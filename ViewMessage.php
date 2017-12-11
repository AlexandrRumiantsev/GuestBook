<html>
<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js\messageJS.js"></script>
</head>
<title>Сообщения</title>
<?
$login=$_GET['log'];
$mail=$_GET['mail'];
$town=$_GET['town'];
$link = mysqli_connect("localhost", "root", "", "GuestBook");
$query  = "SELECT * FROM `Message` WHERE  toUser='$login'";
?>
<body style="background: url(Background.jpg); color:white;">
Сообщения пользователя: <br><?echo $login?><br></body>
<?
require_once  'MyFramework\OneCollection.php';
//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
$mysqliBase = mysqli_query($link, $query);
//Подсчёт сообщений юзеру для вывода на главную
$num_rows =mysqli_num_rows($mysqliBase);
$viewMess = new viewMessage();
$viewMess ->view($mysqliBase);
$msgFinal = $_GET['msg'];
$userToFinal = $_GET['usersTo'];
$userFromFinal = $_GET['usersFrom'];
$timesFinal = $_GET['times'];
$id =  $_GET['id_block'];
$q = "DELETE FROM Message 
	  WHERE
	  message = '$msgFinal' AND
      toUser = '$userToFinal' AND
       fromUser = '$userFromFinal' AND
        times =  '$timesFinal' ";
$mysqli = new mysqli ("localhost", "root", "", "GuestBook");
$mysqli->query("SET CHARSET 'utf8'");
$success = $mysqli->query("$q");
?>
</html>

