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

<html><head>
<? include 'cookie.inc.php' ?>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
<title>GuestBook</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="0">

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
<a href="phpinfo.php">phpinfo</a>
<!-- Проблема с сортировкой по дате-->
<form method="get" action="#" style="color:white;">
<label for="first_name">Имя:</label><br/>
<input type="text" name="first_name" size="30"><br/>
<!-- <label for="Date">Дата:</label><br/>
<input type="date" name="Date" size="30"><br/> -->
<label for="E-Mail">E-Mail:</label><br/>
<input type="text" name="E-Mail" size="30"><br/>
<input id="submit" type="submit" value="Найти и вывести"><br/>
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
else if($Email != null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email' and Users='$first_name'";}
else if($Email != null and $first_name == null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email == null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Users='$first_name'";}
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


				?> <div style="border-style:groove; width:900px; height:300px; background:black; color:white;  background-color:rgba(0, 0, 0, 0.5); padding-bottom:20px;margin-bottom:10px;">
                        <?
                echo"<div  style='float:left; position:relative;'><img style='width:50px; height: 50px; margin: 10px;border-radius: 7px 7px 7px 7px;' src='$row[14]'></div>";
                echo"<div  style='float:left; position:relative; margin-top: 10px;'>$row[0]</div>";

				printf("<div style='float:right;'> %s </div>", $row[4]);
				printf("<br>"); 
				printf("<br>"); 
				printf("<br>");
                    if($row[5] != null) {
                        printf("<p style='display:block; padding-left:100px; width:400px; float:left; word-wrap: break-word;'>%s</p><img style='width:300px; height:200px; padding-left:0px;' src='source\%s'>", $row[1], $row[5]);
                    }else  printf("<p style='display:block; padding-left:100px; width:400px; float:left; word-wrap: break-word;'>%s</p><img style='width:300px; height:200px; padding-left:0px;' src='pic\PicZag.png'",$row[1]);

				 printf("<br>");
                 printf("<br> <br>");

                        ?><?
                    printf("<a target='_blank' href='DelPost.php?nameDel=$row[0]&textDel=$row[1]' style='float:left;'> <img width='30px' height='30px' src='images\close.png'></a>");
                    printf("<a target='_blank' href='RedactPost.php?name=$row[0]&text=$row[1]' style='float:left;'> <img width='30px' height='30px' src='edit.png'></a>");
                        ?></div> <?


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

<div style="align:center; min-width: 1300px; width:100%; height:260px; background:black; background-color:rgba(0, 0, 0, 0.7);  margin-top: 10%;">
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
<input type="text"  id="mess" name="msg_from" value="<? echo $Login; if($Login==Null){echo"Авторезуйтесь";}?>" maxlength="40" size="20">
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
<input type="text"  value="<? echo $mail; if($mail==Null){echo"Авторезуйтесь";}?>" name="msg_mail" maxlength="40" style="margin-right:50px;" size="20">
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
    <button onclick="alert('test');">Click me</button>
<br>

</div>
<br> <div style="width:320px; height:200px; float:left; position:absolute; border-style:groove; float:left; margin-left:250px;"> <p style="margin:80px;  font-size:25px; opacity: 0.5;">Место <br>для картинки</p></div>
<output id="list" style="width:200px; height:200px; float:left;"></output> 
<div>

<div>


<div  style="padding-left:700px">
<div>
* Сообщение:
</div>
<div>
<textarea cols="80" rows="7" id="message" name="msg_message"></textarea>
</div>
* Файл:<input type="file" id="filesPic"  name="filesName" multiple /> 
</div>
<div>

</div>
</div>

<div>

<div style="padding-left:1000px;padding-bottom:10px;">

<input type="submit" name="msg_submit" value="Отправить">


<input type="reset">
					
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


</body>
</html>