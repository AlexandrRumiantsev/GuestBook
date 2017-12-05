<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 20.10.2017
 * Time: 23:53
 */
require_once  'MyFramework\OneCollection.php';
$message=$_POST[msg];
$UserFrom =$_POST[UserFrom];
if($UserFrom==""){echo "<script>alert('Необходимо авторизоваться');</script>";}
else{
$user=$_POST[usersTo];
$time = date('H:i:s');
$messegeUser = new Message();
$messegeUser ->pushToBase($message,$UserFrom,$time,$user);
    echo "<script>alert('Сообщение отправлено');</script>";}
?>