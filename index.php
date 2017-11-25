<?
//--------------------------------------//
// Гостевая книга                      //
// Автор: Александр Румянцев            //
//--------------------------------------//
?>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<html><head>
<? include 'cookie.inc.php' ?>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
<title>GuestBook</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/slide.js" type="text/javascript"></script>
<script src="js/ClockAnAuto.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/slide.css" type="text/css" media="screen" />
</head>
<body style="background: url(Background.jpg)" >
<div>
    <?  include "Panel.php"; ?>
</div>
<div align="center" style="color:white; padding-top:20px;">
<h1>.::Wellcome to GuestBook::.</h1>
</div>
<!-- Панель входа и регистрации на сайт  -->
<div align="center">
<form method="get" action="#" style="color:white;">
<label for="first_name">Имя:</label><br/>
<input type="text" class="focus" style="border-radius: 7px 7px 7px 7px; border-style: solid;" name="first_name" size="30"><br/>
<label for="E-Mail">E-Mail:</label><br/>
<input class="focus" style="border-radius: 7px 7px 7px 7px;  border-style: solid;" type="text" name="E-Mail" size="30"><br/><br/>
<input class="focus" style="border-radius: 7px 7px 7px 7px;" id="submit" type="submit" value="Найти и вывести"><br/>
</form>
<?
//---------- Настройки GB ----------//
$link = mysqli_connect("localhost", "root", "", "GuestBook");
//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
$first_name = $_GET['first_name'];
$Email = $_GET['E-Mail'];
$active= $_GET['page'];
if($active == null){$active = 1;} else $active= $_GET['page'];
if($first_name != null and $Email != null){$query  = "SELECT * FROM `Users` WHERE Users='$first_name'";}
else if($Email != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email != null and $first_name != null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Mail='$Email' and Users='$first_name'";}
else if($Email != null and $first_name == null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Mail='$Email'";}
else if($Email == null and $first_name != null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Users='$first_name'";}
else $query  = 'SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` LIMIT '.(($active*3)-3).",3";
$stmt = mysqli_prepare($link, $query);
//Вытащить все строки из базы и посчитать
$queryAll  = 'SELECT COUNT(1) FROM Users';
$a = mysqli_query($link,$queryAll);
$b = mysqli_fetch_array($a);
$CountAllStringInBase = $b[0];
/////////////Число строк
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$countString = mysqli_stmt_num_rows($stmt);
require_once  'MyFramework\OneCollection.php';
if (mysqli_multi_query($link, $query)) {
    do {
        if ($result = mysqli_store_result($link)) {
            while ($row = mysqli_fetch_row($result)) {
				// тут выводит столбцы из таблицы
                $idMain = $row[0].$row[1].$row[2].$row[3];
				echo "<div  id='$idMain' class='mainBlock'>";
                     /*Форматирую строку с датой */ $expd = explode("-",$row[4]);
                                                      if($row[14]==null){$pic='images\ava.jpg';}else $pic=$row[15];
                echo"<link rel='stylesheet' href='css/styleMessage.css' type='text/css' media='screen' />";
                echo"<div  class='imgIn'>
                     <img class='imgMain'  src='$pic'>
                     </div>";
                $messageClass = new Message();
                $userProf = $messageClass -> formUser($row[0],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$Login);
                echo"<a id='User$row[0]'  class='userID' target='_blank' href='$userProf'>$row[0]</a>";
                echo"
<button data-msg_id='$row[1]' data-user_id='$row[0]' data-louder_id='louder$row[0]$row[1]' class='agaxClose' id='agaxClose' style='background-image: url(images/crestic.png);'>
</button>";
                echo"
<button data-msg_id='$row[1]' data-user_id='$row[0]' data-louder_id='louder$row[0]$row[1]' class='agaxEdit' id='agaxEdit' style='background-image: url(images/edit.png);'>
</button>";
				echo"<br><br><div class='blockOne'> $expd[2].$expd[1].$expd[0]</div><br><br><br><br>";
                echo"<div id='louder$row[0]$row[1]' class='louderClass'><img src='images/loader.gif' /></div>";
                    if($row[5] != null) {
                        printf("<p id='textUsers$row[0]' class='messageID' >%s</p><img class='imgMesage' src='source\%s'>",
                            $row[1], $row[5]);
                    }else  printf("<p id='textUsers$row[0]' class='messageID' style='height:100px;'>%s</p><img class='imgMesage' src='images\pic.jpg'>",
                        $row[1]);
                        echo"</div>";
            }
            mysqli_free_result($result);
        }
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}
$count_pages=$CountAllStringInBase/3;
$count_pages = ceil($count_pages);
  $active = $_GET['page'];
  if($_GET['page']==null) $active = 1;
  $count_show_pages = 1;
  $url = "/index.php";
  $url_page = "/index.php?page=";
  if ($count_pages > 1) {
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
    }
?>
  <!-- Дальше идёт вывод Pagination -->
    <div id='loader' style='position: absolute;padding-left:365px;display: none'><img src='images/loader.gif' /></div>
  <div id="pagination" style="font-size: 23px;">
    <span style="color:white;">Страницы: </span>
    <?php if ($active != 1) { ?>
      <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
      <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
    <?php if ($i == $active) { ?><span style="background: white;border-radius: 5px;font-size: 28px;"><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?>
    <?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
    <?php } ?>
  </div>
<!-- END Pagination -->
<br>
</div>
<div style="min-width: 1300px; width:100%; height:260px; background:black; background-color:rgba(0, 0, 0, 0.7);  margin-top: 13%; position:absolute;">
<form  method="post" value="Отправить" action="New.php" enctype="multipart/form-data">
<div style="color: white;" bgcolor="black">
<div style="float:left; padding-left:20px; padding-right:10px; padding-top:10px;">
<div style="float:left;">
<div>
<div>
* Имя:
</div>
<div align="left">
<input type="text" class="focus" style="border-style: solid;border-radius: 7px 7px 7px 7px;" id="mess" name="msg_from" value="<?echo $Login;?>" placeholder="<?if($Login==Null){echo"Авторезуйтесь";}?>"maxlength="40" size="20">
</div>
</div>
</div>
<br><br><br><br>
<div style="float:left;">
<div>
<div>
E-Mail:
</div>
<div align="left">
<input type="text"  class="focus" style="border-style: solid; border-radius: 7px 7px 7px 7px;" value="<?echo $mail;?>" placeholder="<?if($mail==Null){echo"Авторезуйтесь";}?>" name="msg_mail" maxlength="40" style="margin-right:50px;" size="20">
</div>
</div>
</div>
<br><br><br><br><br>
</div>
<br>
    <label>
<div class="picFooter" style="width:320px; height:200px; float:left; position:absolute; border-style:groove; float:left; margin-left:250px;"> <img style="width:130px; height:130px; padding: 30px 100px; opacity: .06;" src="images/fotik.png">
    <input type="file" id="filesPic" name="filesName" style="display: none" multiple />
</div>
<output id="list" style="width:200px; height:200px; float:left; padding-left:49px;"></output>
<div>
    </label>
<div>
<div  style="padding-left:700px">
<div>
* Сообщение:
</div>
<div>
<textarea class="focus" cols="80" rows="7" id="message" name="msg_message" style="border-radius: 7px 7px 7px 7px;border-style: solid;"></textarea>
</div>
</div>
<div>
</div>
</div>
<div>
<div style="padding-left:1000px;padding-bottom:10px;">
<input type="submit" style="border-radius: 7px 7px 7px 7px;" name="msg_submit" value="Отправить">
<input type="reset" style="border-radius: 7px 7px 7px 7px;">
</div>
</div>
</div>
</div>
</form>
</div>
<script type="text/javascript" src="js\indexScript.js"></script>
</body>
</html>