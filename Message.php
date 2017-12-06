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
if($UserFrom==""){?><script language='javascript' type='text/javascript'>alert('Необходимо авторизоваться');</script><?;}
else{
    echo "<script language='javascript' type='text/javascript'>alert('Сообщение отправлено');</script>";
$user=$_POST[usersTo];
$time = date('H:i:s');
$messegeUser = new Message();
$messegeUser ->pushToBase($message,$UserFrom,$time,$user);
    }
?>