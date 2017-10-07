<?php
$name= $_GET[name];
$q= $_GET[un1];
$q1= $_GET[un2];
$q2= $_GET[un3];
$q3= $_GET[un4];
$q4= $_GET[un5];
$q5= $_GET[un6];
$q6= $_GET[un7];
$q7= $_GET[un8];
$q8= $_GET[un9];
$q9= $_GET[un10];
$q10= $_GET[un11];
$q11= $_GET[un12];
$q12= $_GET[un13];
$q13= $_GET[un14];
//echo "$q1, $q2, $q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13";
echo"
<head> 
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\">
   <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css\"> 
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script> 
</head>
<body style='background-image:url(Background.jpg);'>
<div class='container' style='margin-top:140px; background-color:rgba(0, 0, 0, 0.5);  display: block; width: 500px; height: 300px; border-style: groove;'>
<img src='$q13'  style='float:left; margin-top: 32px;margin-left:15px; margin-right:35px; width: 200px; height:200px;'>
<div style='float:left; margin-top: 32px; color:white;'>Пользователь:<br>$name<br>
<br>
E-mail:$q9<br>
Пол:$q11<br>
Возраст:$q12<br><br><br><br>
<button style='background: black;'>написать сообщение</button>
</div>
</div>
</body>";
?>
