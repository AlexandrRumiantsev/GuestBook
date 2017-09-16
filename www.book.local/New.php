<?php  
$text = $_POST['msg_message'];
$name = $_POST['msg_from'];
$mail = $_POST['msg_mail'];
$url = $_POST['msg_url'];

//Работа с картинкой
$file = $_FILES['filesName'];

if($text == null or $name == null or $file == null){echo "необходимо заполнить Имя, Сообщение  и добавить файл";} 
$nameFile = $_FILES['filesName']['name'];
//Определяем IP и Браузер пользователя
$Br = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
//Проверка файла на ТИП
if($_FILES['filesName']['type'] == "image/gif" or 
   $_FILES['filesName']['type'] =="image/jpeg" or 
   $_FILES['filesName']['type'] =="image/jpg" or 
   $_FILES['filesName']['type'] =="image/png" or 
   $_FILES['filesName']['type'] == 'text/plain')
{}else{echo"Error!!"; echo "Недопустимый формат файла!";}

//Проверка файла на РАЗМЕР не более 1мб
if($_FILES['filesName']['size'] < 1048576)
{}else{echo"Error!!"; echo "Недопустимый вес файла!";}

//Проверка текстового файла на РАЗМЕР 
if($_FILES['filesName']['type'] == 'text/plain' and $_FILES['filesName']['size'] < 100)
{};

//Запись файла в папку + Запись пути к файлу(В БД)
	
function save_source_code($cName)
{
/* $cache = fopen("source\ " .$_FILES['filesName']['name'], 'w+');
@copy($file ,"source\ "); */

$path = "source/".$_FILES["filesName"]["name"];
move_uploaded_file($_FILES["filesName"]["tmp_name"], $path);

/* fwrite($cache,$_FILES['filesName']['name']);
fclose($cache); */
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* 
$uploaddir = '/source/';
$uploadfile = $uploaddir . basename($_FILES['files']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['files'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

print "</pre>"; */

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Запись файла в папку НЕ РАБОТАет этот вариант
$mCode = save_source_code($_FILES['filesName']);
					
//$path = 'source\ ';


$pathPicture = $path . $_FILES['filesName']['names'];

$text = strip_tags($text);
$name = strip_tags($name);
$comment =   '<div style="font-weight:bolder; align:center;">'  .'</div>'  .'<br>'  .'<p style="width:340px;">' .$text .'</p>' .'<hr style="display:block; width:200px;">';       
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//Запись данных в БД
	$mysqli = new mysqli ("localhost","root","","GuestBook");
      $mysqli -> query ("SET CHARSET 'utf8'");
	 $date = date('Y-m-d');
	 $q = "INSERT INTO Users (Users,Date,Mail,Url,Text,Photo,IP,Brouse) VALUES ('$name','$date','$mail','$url','$text', '$nameFile','$ip','$Br')";
     $success = $mysqli -> query ("$q");
    if($success == 1){$mysqli -> close (); 	
	header('Location: index.php');}
	else echo "Произошла ошибка";
    //
?>