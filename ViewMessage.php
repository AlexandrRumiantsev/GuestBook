<html>
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

//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");

$mysqliBase = mysqli_query($link, $query);
//Подсчёт сообщений юзеру для вывода на главную
$num_rows =mysqli_num_rows($mysqliBase);
while($row=mysqli_fetch_assoc($mysqliBase)){
    ?><div style="border-style: groove;word-wrap: break-word; width: 800px;margin-left:300px; padding: 20px;"><?
    echo $row["fromUser"]." в ";
    echo $row["times"]." написал вам:<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $row["message"];
    echo "<br>";
    ?></div><?
}
?>
</html>

