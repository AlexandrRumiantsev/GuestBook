<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 02.11.2017
 * Time: 21:15
 *
 */
echo '<style>   a {
    text-decoration: none; 
   }</style>';
echo "Adminka";
echo'<br>';
//Верхнее меню
echo '<a href="MainAdmin.php?Page=main">Главная </a>';
echo '<a href="MainAdmin.php?Page=stat">Статистика </a>';
echo '<a href="MainAdmin.php?Page=user">Пользователи </a>';
echo '<a href="MainAdmin.php?Page=message">Сообщения </a>';
echo '<a href="MainAdmin.php?Page=setting">Настройки </a>';
?>

<?
$page = $_Get['Page'];
echo'<br>';
if($_REQUEST['Page']=='setting') {include 'setting.php';}
else if($_REQUEST['Page']=='stat'){include 'stat.php';}
else if($_REQUEST['Page']=='user'){include 'user.php';}
else if($_REQUEST['Page']=='message'){include 'message.php';}
 else  include 'main.php';
?>
