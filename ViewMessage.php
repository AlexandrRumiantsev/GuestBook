<html>
<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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

//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");

$mysqliBase = mysqli_query($link, $query);
//Подсчёт сообщений юзеру для вывода на главную
$num_rows =mysqli_num_rows($mysqliBase);
while($row=mysqli_fetch_assoc($mysqliBase)){
	$text = $row["message"];
    $userFrom = $row["fromUser"];
    $userTo = $row["toUser"];
    $userTime = $row["times"];
	global $blockId;
    $blockId = $userFrom .$userTo .$text;
    echo "<div id='$blockId' style='border-style: groove;word-wrap: break-word; width: 800px;margin-left:300px; padding: 20px;'>";
    
    echo $row["fromUser"]." в ";      echo "<div style='float:right;'><button class='otvet' style='margin:5px; background-size: cover; background-image: url(images/conv.png); width: 20px; height:20px;'></button>
                                                                      <button data-msg_text='$text'   data-id_block='$blockId' data-user_from='$userFrom' data-user_to='$userTo' data-time='$userTime' class='close' style='margin:5px; background-size: cover; background-image: url(images/crestic.png); width: 20px; height:20px;'></button>";
    echo "</div>";
    echo $row["times"]." написал вам:<br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo $row["message"];
    echo "<br>";
    echo "</div>";
}
?>


<script type="text/javascript">
    $(document).ready(function(){
        $(".close").click(function(){
           var msg = $(this).data('msg_text');
           var usersTo = $(this).data('user_to');
            var usersFrom = $(this).data('user_from');
            var times = $(this).data('time');
			var idBlock = $(this).data('id_block');
            var result = confirm('Удалить?');
            if(result) {
                $.ajax({
                    url: 'ViewMessage.php',
                    data: {msg: msg, usersTo: usersTo, usersFrom: usersFrom, times:times},
                    success: function(){
                        //скрытие блока
                        $("#"+idBlock).hide();
                        alert('Сообщение удалено');},
                    type: 'GET',
                        beforeSend: function () {
                            //скрытие блока
                            $("#"+idBlock).hide();
                        }
            })}
	})});
</script>

<!--<script type="text/javascript">
    $(document).ready(function(){
        $(".otvet").click(function(){
           // var msg = $(this).data('msg_id');
            //var users = $(this).data('user_id');
           // var louder = $(this).data('louder_id');
            var result = prompt('Введите текст для изменения сообщения');
            if(result) {
                $.ajax({
                    url: 'RedactPost.php',
                    data: {nameUpp: users, textUpp: result, oldText: msg},
                    success: function(){
                        alert('Запись изменена');
                    },
                    type: 'GET',
                    beforeSend: function () {
                        $("#"+louder).css("display", "block");
                        $("#"+louder).animate({opacity: 1}, 500);
                    }
                }).done(function (data) {
                    $("#"+louder).animate({opacity: 0}, 500, function () {
                        $("#"+louder).css("display", "none");
                    });
                });
                //после отработки функции, делаю редирект, чтобы увидеть результат.
                window.location.href = 'index.php';
            }});
    });
</script>-->

<?
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

