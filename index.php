<?
//--------------------------------------//
// Гостевая книга                      //
// Автор: Александр Румянцев            //
//--------------------------------------//
?>
<html>
<head>
<?
include 'cookie.inc.php';
include 'setting.php';
?>
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
require_once  'MyFramework\OneCollection.php';
error_reporting(0);
//---------- Настройки GB ----------//
$link = mysqli_connect("localhost", "root", "", "GuestBook");
//Вывод кирилицы из БД
$link->set_charset("utf8");
$first_name = $_GET['first_name'];
$Email = $_GET['E-Mail'];
$active= $_GET['page'];
if($active == null){$active = 1;} else $active= $_GET['page'];
$sqlSort = new sqlSort();
$query = $sqlSort ->sqlSort($Email,$first_name,$active);
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
$blocksMain = new blocksMain();
$blocksMain ->blocksMain($link, $query,$Login);
///////////////////////////////////////////////////////////////////////////
$count_pages=$CountAllStringInBase/3;
$count_pages = ceil($count_pages);
  $active = $_GET['page'];
  if($_GET['page']==null) $active = 1;
$pagination = new pagination();
$pagination ->paginationEnter($count_pages, $active)
 ?>
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
<input type="text" class="focus" style="border-style: solid;border-radius: 7px 7px 7px 7px;" id="mess" name="msg_from" value="<?global $Login;echo $Login; ?>"
       placeholder="<?if($Login==Null){echo"Авторезуйтесь";}?>"maxlength="40" size="20">
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
<input type="text"  class="focus" style="border-style: solid; border-radius: 7px 7px 7px 7px;" value="<?echo $mail;?>" placeholder="<?if($mail==Null){echo"Авторезуйтесь";}?>"
       name="msg_mail" maxlength="40" style="margin-right:50px;" size="20">
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
<?
require_once  'MyFramework\OneCollection.php';
$user = new userInfo();
?>
</html>