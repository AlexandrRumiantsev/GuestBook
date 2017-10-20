<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 20.10.2017
 * Time: 23:53
 */
$message=$_POST[msg];
$UserFrom =$_POST[UserFrom];
$user=$_POST[usersTo];
$time = date('H:i:s');
pushToBase($message,$UserFrom,$time,$user);
function pushToBase($message,$UserFrom,$time,$user){
$mysqli = new mysqli ("localhost","root","","GuestBook");
$mysqli -> query ("SET CHARSET 'utf8'");
$q = "INSERT INTO Message (message,fromUser,toUser,times) VALUES ('$message','$UserFrom','$user','$time')";
$success = $mysqli -> query ("$q");
if($success == 1){echo"<script>alert('всё ок')</script>";}
else echo "<script>alert('Ошибка')</script>";};
?>