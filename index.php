<?
//--------------------------------------//
// Гостевая книга                      //
// Автор: Александр Румянцев            //
//--------------------------------------//
?>

<style>
    .bloock{
        float:left;margin-left: 70px; width:140px; height: 200px; background: black; display: none;
    }
</style>
<style>
.picFooter:hover{
border-color: yellow;
}
</style>
<style>
.focus:hover{
border-color: yellow;
}
.focus:focus{
outline: none;
border-color: yellow;
}
</style>

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
<!-- Проблема с сортировкой по дате-->
<form method="get" action="#" style="color:white;">
<label for="first_name">Имя:</label><br/>
<input type="text" class="focus" style="border-radius: 7px 7px 7px 7px; border-style: solid;" name="first_name" size="30"><br/>
<!-- <label for="Date">Дата:</label><br/>
<input type="date" name="Date" size="30"><br/> -->
<label for="E-Mail">E-Mail:</label><br/>
<input class="focus" style="border-radius: 7px 7px 7px 7px;  border-style: solid;" type="text" name="E-Mail" size="30"><br/><br/>
<input class="focus" style="border-radius: 7px 7px 7px 7px;" id="submit" type="submit" value="Найти и вывести"><br/>
</form>

<?

//---------- Настройки GB ----------//
$file_gb = "Letter.txt"; // файл где хранятся записи GB
$max_rec = 128; // максимальное количество записей в файле
$rec_page = 6; // количество записей выводимых на одной странице
//----------------------------------//

	
//=====================================================================================================================================================//
$link = mysqli_connect("localhost", "root", "", "GuestBook");

//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
//=====================================================================================================================================================//

//$offset = ($active - 1) * 3;
//$query  = 'SELECT * FROM Users LIMIT 3 OFFSET '.$offset;
//$query  = 'SELECT * FROM Users';

//Условия сортировки на запрос

$first_name = $_GET['first_name'];

//$Date = $_POST['Date'];
$Email = $_GET['E-Mail'];
$active= $_GET['page'];
if($active == null){$active = 1;} else $active= $_GET['page'];

//Вытащить все строки из базы и посчитать



//Реализация сортировки
/*if($first_name != null and $Email != null){$query  = "SELECT * FROM `Users` WHERE Users='$first_name'";}
else if($Email != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email != null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email' and Users='$first_name'";}
else if($Email != null and $first_name == null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email == null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Users='$first_name'";}
else $query  = 'SELECT * FROM Users LIMIT '.(($active*3)-3).",3";*/

//Тестирую
//$queryTest = "SELECT `Users`.*,`RegUsers`.* FROM `Users`,`RegUsers` WHERE `Users`=`Log` ";
//$Test = mysqli_query($link,$queryTest);

//УСПЕХ! Но при сортировке запросы не вытягивают картинки! ПОПРАВЛЮ.
if($first_name != null and $Email != null){$query  = "SELECT * FROM `Users` WHERE Users='$first_name'";}
else if($Email != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email != null and $first_name != null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Mail='$Email' and Users='$first_name'";}
else if($Email != null and $first_name == null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Mail='$Email'";}
else if($Email == null and $first_name != null) {$query  = "SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Users='$first_name'";}
else $query  = 'SELECT `Users`.* ,`RegUsers`.* FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` LIMIT '.(($active*3)-3).",3";




//////////////////////////////////////////////////////////////////////////////
$stmt = mysqli_prepare($link, $query);

//Вытащить все строки из базы и посчитать
$queryAll  = 'SELECT COUNT(1) FROM Users';
$a = mysqli_query($link,$queryAll);
$b = mysqli_fetch_array($a);
$CountAllStringInBase = $b[0];
/////////////Число строк\\\\\\\\\\\\\\\\\\\ 
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$countString = mysqli_stmt_num_rows($stmt);




if (mysqli_multi_query($link, $query)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link)) {
			
            while ($row = mysqli_fetch_row($result)) {
				// тут выводит столбцы из таблицы

                $idMain = $row[0].$row[1].$row[2].$row[3];
				echo "<div  id='$idMain' style='border-style:groove; width:900px; height:350px; background:black; color:white;  background-color:rgba(0, 0, 0, 0.5); padding-bottom:20px;margin-bottom:10px;'>";
                     /*Форматирую строку с датой */ $expd = explode("-",$row[4]);
                                                      if($row[14]==null){$pic='images\ava.jpg';}else $pic=$row[14];
                echo"<div  style='float:left; position:relative;'><img style='width:50px; height: 50px; margin: 10px;border-radius: 7px 7px 7px 7px;' src='$pic'></div>";
echo"
<style>
.messageID {
  border: 1px solid black;
  width: 200px;
  height: 210px;
  overflow: hidden;
  font-size: 14px;
  margin-top:0px;
  padding-top:0px;
}
.messageID:hover {
  height: auto;
  cursor: pointer;
  background:black:
  position: fixed;
  max-height:210px;
  overflow-y:auto;
}
</style>";

echo"
<style>
::-webkit-scrollbar-button {
background-image:url('');
background-repeat:no-repeat;
width:5px;
height:0px
}

::-webkit-scrollbar-track {
background-color:white;
}

::-webkit-scrollbar-thumb {
-webkit-border-radius: 0px;
border-radius: 0px;
background-color:yellow;
}

::-webkit-scrollbar-thumb:hover{
background-color:black;
}

::-webkit-resizer{
background-image:url('');
background-repeat:no-repeat;
width:4px;
height:0px
}

::-webkit-scrollbar{
width: 4px;
}
</style>";
                echo"<a id='User$row[0]'  class='userID' target='_blank' href='ProfileUsers.php?name=$row[0]&un1=$row[1]&un2=$row[2]&un3=$row[3]&un4=$row[4]&un5=$row[5]&un6=$row[6]&un7=$row[7]&un8=$row[8]&un9=$row[9]&un10=$row[10]&un11=$row[11]&un12=$row[12]&un13=$row[13]&un14=$row[14]&un15=$Login'  style='float:left; position:relative; margin-top: 10px;'>$row[0]</a>";
                   // printf("<a target='_blank' href='DelPost.php?nameDel=$row[0]&textDel=$row[1]' style='float:right;'> <img width='30px' height='30px' src='images\close.png'></a>");
                   // printf("<a target='_blank' href='RedactPost.php?name=$row[0]&text=$row[1]' style='float:right;'> <img width='30px' height='30px' src='edit.png'></a>");
                    printf("<button data-msg_id='$row[1]' data-user_id='$row[0]' data-louder_id='louder$row[0]$row[1]' class='agaxClose' id='agaxClose' style='margin:5px; border-radius: 10px 10px 10px 10px; float:right;background-image: url(images/crestic.png); background-size: cover;  width: 30px; height:30px;'></button>");

                    printf("<button data-msg_id='$row[1]' data-user_id='$row[0]' data-louder_id='louder$row[0]$row[1]' class='agaxEdit' id='agaxEdit' style='margin:5px; border-radius: 10px 10px 10px 10px; float:right;background-image: url(images/edit.png); background-size: cover;  width: 30px; height:30px;'></button>");

				echo"<br><br><div style='float:left;position:relative; display:block; height: 16px;'> $expd[2].$expd[1].$expd[0]</div>";
				printf("<br>"); 
				printf("<br>"); 
				printf("<br>");
                printf("<br>");
                printf("<div id='louder$row[0]$row[1]' style='position: absolute;padding-left:365px;display: none;'><img src='images/loader.gif' /></div>");

                    if($row[5] != null) {
                        printf("<p id='textUsers$row[0]' class='messageID' style='display:block; padding-left:100px; width:400px; float:left; word-wrap: break-word;'>%s</p><img style='width:300px; height:200px; padding-left:0px;' src='source\%s'>", $row[1], $row[5]);
                    }else  printf("<p id='textUsers$row[0]' class='messageID' style='margin:0px;overflow: hidden;height:100px;display:block; padding-left:100px; width:400px; float:left; word-wrap: break-word;'>%s</p><img style='width:300px; height:200px; padding-left:0px;' src='images\pic.jpg'>",$row[1]);
                        echo"</div>";
            }
            mysqli_free_result($result);
        }
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}

/* закрываем соединение */
//mysqli_close($link); 
//.................................... Pagination -->
  /* Входные параметры */
  //Общее страниц в пагинации
$count_pages=$CountAllStringInBase/3;
$count_pages = ceil($count_pages);
  $active = $_GET['page'];
  if($_GET['page']==null) $active = 1;
  $count_show_pages = 1;
  $url = "/index.php";
  $url_page = "/index.php?page=";
  if ($count_pages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
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
      <?php if ($i == $active) { ?><span style="background: white;border-radius: 5px;font-size: 28px;"><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
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
<!-- КАК В ЛОГИНЕ МОЖЕТ БЫТЬ ЧИСЛО 1(Он глобальный, объявлен в Panel) -->
<input type="text" class="focus" style="border-style: solid;border-radius: 7px 7px 7px 7px;" id="mess" name="msg_from" value="<?echo $Login;?>" placeholder="<?if($Login==Null){echo"Авторезуйтесь";}?>"maxlength="40" size="20">
</div>
</div>
</div>
<br>
<br>
<br>
<br>
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
<br>
<br>
<br>
<br>

<!-- <div style="float:right;">
<div>
<div>
URL:
</div>
<div align="left">
 <input style="float:right; margin-right:50px;" type="text" name="msg_url" maxlength="40" size="20">
</div>
</div>
</div> -->

<br>

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
<!--Файл:<input type="file" id="filesPic" name="filesName" multiple />-->
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

<script type="text/javascript">
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    for (var i = 0, f; f = files[i]; i++) {

      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile) {
        return function(e) {
        
          var span = document.createElement('span');
	
	
          span.innerHTML = ['<img style="width:320px; height:200px; float:left; " class="thumb" src="', e.target.result,
                            '" title="', theFile.name, '"/>'].join('');
							
          document.getElementById('list').innerHTML = '';
          document.getElementById('list').insertBefore(span, null); 
        };
      })(f);

      reader.readAsDataURL(f);
    }
  }

document.getElementById('filesPic').addEventListener('change', handleFileSelect, false);
</script>

<!-- роверка логирования -->
<script>
    var Log = document.getElementById("mess");
    if(Log=="авторизуйтесь"){alert("авторизуйтесь!")}
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(".agaxClose").click(function(){
            var msg = $(this).data('msg_id');
            var users = $(this).data('user_id');
			var louder = $(this).data('louder_id');
            var result = confirm('Удалить сообщение: ' + msg + ' Пользователя: ' + users);
            if(result) {
                $.ajax({
                    url: 'DelPost.php',
                    data: {nameDel: users, textDel: msg},
                    success: function(){
                        alert('Запись успешно удалена');
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
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".agaxEdit").click(function(){
          var msg = $(this).data('msg_id');
          var users = $(this).data('user_id');
		  var louder = $(this).data('louder_id');
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
</script>
</body>
</html>