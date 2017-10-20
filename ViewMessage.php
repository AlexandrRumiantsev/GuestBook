<html>
<title>Сообщения</title>
<?

$login=$_GET['log'];
$mail=$_GET['mail'];
$town=$_GET['town'];

$link = mysqli_connect("localhost", "root", "", "GuestBook");
$query  = "SELECT * FROM `Message` WHERE  toUser='$login'";
?>
<body>
Сообщения пользователя: <?echo $login?><br></body>

<?
//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");

$mysqliBase = mysqli_query($link, $query);
while($row=mysqli_fetch_assoc($mysqliBase)){

    echo $row["times"]." ";
    echo $row["fromUser"]." ";
    echo $row["message"];
    echo "<br>";
}
?>
</html>

