<?php
require_once  'MyFramework\OneCollection.php';
$text = $_POST['msg_message'];
$name = $_POST['msg_from'];
$mail = $_POST['msg_mail'];
$url = $_POST['msg_url'];
$time = time();
//Работа с картинкой
$file = $_FILES['filesName'];
if($text == null or $name == null){echo "<script> alert('Необходимо авторизоватся и заполнить поле - Сообщение'); window.location.href = 'index.php';</script>";} 
$nameFile = $_FILES['filesName']['name'];
//Определяем IP и Браузер пользователя
$Br = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
$type = $_FILES['filesName']['type'];
$size = $_FILES['filesName']['size'];
//Проверка файла на вес и тип
$audit = new audit();
$resultAuditSize = $audit ->auditSize($size);
$resultAuditType = $audit ->auditType($type);
//Запись файла в папку
$file = $_FILES["filesName"]["name"];
$fileTmp =$_FILES["filesName"]["tmp_name"];
$fileToDirect = new fileToDirect();
$mCode = $fileToDirect->save_source_code($file,$fileTmp);
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
	 $q = "INSERT INTO Users (Users,Date,Mail,Url,Text,Photo,IP,Brouse,times) VALUES 
                             ('$name','$date','$mail','$url','$text','$nameFile','$ip','$Br','$time')";
     $success = $mysqli -> query ("$q");
    if($success == 1){$mysqli -> close (); 	
	header('Location: index.php');}
	else echo "Произошла ошибка";
?>