<?
//Авторизация
global $Login;
global $mail;

$Login=$_POST['log'];
$Password=$_POST['pwd'];

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	if($Login =! null){
	//Авторизация
	$link = mysqli_connect("localhost", "root", "", "GuestBook");
	$q = "SELECT * FROM `RegUsers`";
	//Вывод кирилицы
	mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    mysqli_query($link, "SET CHARACTER SET 'utf8'");

    /* if($success == 1){$mysqli -> close ();}
	else echo "Произошла ошибка"; */
	
	
	if (mysqli_multi_query($link, $q)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link)) {
            while ($row = mysqli_fetch_row($result)) {
				if($Login == $row[0]  and $Password == $row[1]){
                printf("<div style='background:black;  border-radius: 7px 7px 7px 7px; float:left; color:white; width:250px; height:100px; border-style:groove; position:absolute; font-size:18px;'> 
                           <img style='width:90px; height:90px; padding-left:9px; padding-right:11px; padding-top:7px; margin-left:0px; float:left; border-radius: 75px 75px 75px 75px;' src='%s' > 
         				   <form action='Profile.php?mail=$row[2]&town=$row[3]&pol=$row[4]&years=$row[5]&pic=$row[6]' method='post'>  <input  value='%s' type='text' class='text' style='background-color:black; color:white; padding-left:19px;  margin-top: 12px;  margin-bottom: 7px;  border-radius: 7px 7px 7px 7px; ' name='login' maxlength='20' size='10'>  <form> 
         				   <br>
         				   <div style='padding-left:44px;display:block;'>
						 <input type='submit' style='width:35px; height:35px; border-radius: 7px 7px 7px 7px;' class='subm' name='submitUser' value=''/>
						 <a href='#'> <div style='width:48px;height:35px; display: inline-block;  background-image:url(onebit_42.png); margin-top:6px; border-radius: 10px 10px 10px 10px;'> <div style='font-size: 30px; padding-left:15px; padding-top:16px;'>1 </div></div></a> 
						 <a href='index.php'> <img style='width:35px;height:35px;padding-top:10px;' src='images/close.png'> </a> 
						</div>
						 </div> ",$row[6] , $row[0]);
					$Login = $row[0];
					$mail = $row[2];
				}
				//else echo("<script>alert('Вы ввели неправильный логин или пароль!'); window.location.href = 'index.php';</script>");
            }
            mysqli_free_result($result);
        }else { echo "Ничего не найдено";}
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}
	}
}

?>

<div id="toppanel" align="right" >
	<div id="panel" style = "width:460px; background: rgba(, , , 0.7); border-style:outset; background:black;">
		<div class="content clearfix" width="500px" style="background:black;" >
			<div class="left" style="width:200px;" style ="margin: 0px">
				<!-- Login Form -->
				<form class="clearfix" action="#" method="post" style="float:left;">
					<h1>Авторизация</h1>
					<label class="grey" for="log">Логин:</label>
					<input class="field" type="text" name="log" id="log" value="" size="23" style="border-style: groove; background: gray;"/>
					<label class="grey" for="pwd">Пароль:</label>
					<input class="field" type="password" name="pwd" id="pwd" size="23" />
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Запомнить</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Войти" class="button normal white" />
				</form>
			</div>
			
			  <div class="left right" style="width:200px;" style ="margin: 0px">
				<!-- Register Form -->
				<form action="rega.php" method="post">
					<h1>Зарегистрироваться</h1>		
					<label class="grey" for="Log">Логин:</label><br/>
					<input class="field" type="text" name="Log" id="Log" value="" size="23" />
					
					<label class="grey" for="pass">Пароль:</label><br/>
					<input class="field" type="text" name="pass" id="pass" value="" size="23" />
					
					<label class="grey" for="email">E-Mail:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					
					<label>Быстрая Регистрация</label>
					<input type="submit" name="submit"  value="Регистрация"   class="button normal white" />
				</form>
			</div>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login" style="float:right; padding:0px; margin:0px;">

	       <li class="welcome" style="background: rgba(, , , 0.7); background:black;"></li> 
		   <li id="toggle" style="background: rgba(, , , 0.7); background:black;"">
				<a id="open" class="open" href="#">Открыть панель</a>
				<a id="close" style="display: none;" class="close" href="#">Закрыть панель</a>			
			</li>

		</ul> 
	</div> <!-- / top -->

	<style>
	.subm {
		background-size:contain;
		background-image: url(images/edit.png);
	}
	</style>

	<style>
	.close{
	background-image: url(images/close.png);
	}
	</style>

	<style>
	.text{
	  background-color: #f6f6f6; /*Цвет текстового поля*/
	  border-radius: 10px 10px 10px 10px; /*Закругляем уголки*/
	}
	</style>