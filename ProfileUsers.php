<?php
//поправить тут
$name= $_GET["name"];
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
$user = $_GET[un15];
$pic = $_GET[pic];
echo"
<head> 
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css\">
   <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css\"> 
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script> 
  <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
</head>
<body style='background-image:url(Background.jpg);'>
<div class='container' style='margin-top:140px; background-color:rgba(0, 0, 0, 0.5);  display: block; width: 500px; height: 300px; border-style: groove;'>
<img src='$pic'  style='float:left; margin-top: 32px;margin-left:15px; margin-right:35px; width: 200px; height:200px;'>
<div style='float:left; margin-top: 32px; color:white;'>Пользователь:<br>$name<br>
<br>
E-mail:$q10<br>
Пол:$q12<br>
Возраст:$q13<br>
Город:$q11<br><br><br><br>
<button style='background: black;' data-user_from='' data-user_to='$name'  class='message'>написать сообщение</button>
</div>
<div id='louder' style='position: absolute;padding-left:165px; padding-top:65px; display: none;'><img src='images/loader.gif' /></div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        $('.message').click(function(){
          var msg = prompt('Введите сообщение');
          var usersTo = '$name';
          var UserFrom = '$user'; 
            if(msg) {
                $.ajax({
                    url: 'Message.php',
                    data: {usersTo: usersTo, msg: msg, UserFrom: UserFrom},               
                    type: 'POST',
                    beforeSend: function () {
                        $(\"#\"+'louder').css(\"display\", \"block\");
                        $(\"#\"+'louder').animate({opacity: 1}, 500);
                    }
                });  
                //после отработки функции, делаю редирект, чтобы увидеть результат.
                window.location.href = 'ProfileUsers.php?name=$name&un1=$q&un2=$q1&un3=$q2&un4=$q3&un5=$q4&un6=$q5&un7=$q6&un8=$q7&un9=$q8&un10=$q9&un11=$q10&un12=$q11&un13=$q12&un14=$q13&un15=$user';
            }else alert('Сообщение не отправлено');});
    });
</script>
</body>";
?>
