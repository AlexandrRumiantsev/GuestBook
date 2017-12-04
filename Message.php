<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 20.10.2017
 * Time: 23:53
 */
require_once  'MyFramework\OneCollection.php';
$message=$_POST[msg];
$UserFrom =$_POST[userFrom];
$user=$_POST[usersTo];
$time = date('H:i:s');
$messegeUser = new Message();
$messegeUser ->pushToBase($message,$UserFrom,$time,$user);
?>