<!DOCTYPE html>
<html>

<head> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
</head>

<body  align="center" style='background-image: url(Phone.jpg);'>

<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 02.11.2017
 * Time: 21:15
 *
 */
echo '<link rel="stylesheet" href="style.css">';
echo '<style>   a {
    text-decoration: none; 
   }</style>';
echo "Adminka";
echo'<br>';
//Верхнее меню
echo '<div class="cont">';
echo '<a href="MainAdmin.php?Page=main"><img class="imgAdm" src="img1.png"> </a>';
echo '<a href="MainAdmin.php?Page=stat"><img class="imgAdm" src="img2.png"></a>';
echo '<a href="MainAdmin.php?Page=user"><img class="imgAdm" style="margin-top:12px;"src="users.png"> </a>';
echo '<a href="MainAdmin.php?Page=message"><img class="imgAdm" src="conv.png">  </a>';
echo '<a href="MainAdmin.php?Page=setting"><img class="imgAdm" src="set.png"> </a>';
echo '</div>';
?>

<?
$page = $_Get['Page'];
echo'<br>';
echo '<div class="cont2">';
if($_REQUEST['Page']=='setting') {include 'setting.php';}
else if($_REQUEST['Page']=='stat'){include 'stat.php';}
else if($_REQUEST['Page']=='user'){include 'user.php';}
else if($_REQUEST['Page']=='message'){include 'message.php';}
 else  include 'main.php';
 echo '</div>';
?>

</body>
</html>