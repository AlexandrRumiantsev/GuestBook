<?
//Авторизация
global $Login;
$Login=$_POST['log'];
$Password=$_POST['pwd'];
//Регистрация
/* $LoginReg = $_POST['signup'];
$PasswordReg = $_POST['pass'];
$EmailReg = $_POST['email']; */

// if($LoginReg =! null){
// $mysqli = new mysqli ("localhost","root","","GuestBook");
// $mysqli -> query ("SET CHARSET 'utf8'");
	// $q = "INSERT INTO RegUsers (Log,Pass,mail) VALUES ('$LoginReg','$PasswordReg','$EmailReg')";
    // $success = $mysqli -> query ("$q");
    // if($success == 1){$mysqli -> close ();}
	// }

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
                printf("<div style='background:black; float:left; color:white; width:190px; height:100px; border-style:groove; position:absolute; font-size:18px;'> 
         				   <form action='Profile.php' method='post'>  <input  value='%s' type='text' class='text' style='background-color:black; color:white; padding-left:17px; margin-left:46px; ' name='login' maxlength='20' size='10'>  <form> 
         				   <br>
						 <input type='submit' class='subm' name='submitUser' value=''/>
						 <a href='index.php'> <div style='width:50px;height:50px; display: inline-block;  background-image:url(onebit_42.png); margin-top:6px; border-radius: 10px 10px 10px 10px;'> <div style='font-size: 35px; padding-left:13px; padding-top:16px;'>1 </div></div></a> 
						 <a href='index.php'> <img style='width:50px;height:50px;padding-top:10px;' src='images/close.png'> </a> 
						
						 </div> ", $row[0],$row[2],$row[3],$row[4],$row[5]);
				}
				//БАГ С УСЛОВИЕМ(ВСЕГДА ВЫВОДИТ)(РЕШЕНО)
				/* else if($Login != $row[0]  or $Password != $row[1]){  echo "<div style='float:left; color:white; width:200px; height:50px; border-style:groove; position:absolute;'> Ошибкаq авторизации!</div>";}
				else {echo"ERROR!";} */
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
	<div id="panel" style = "width:300px; background: rgba(, , , 0.7); border-style:outset; background:black;">
		<div class="content clearfix" width="300px" style="background:black;" >
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
			
			<!--  <div class="left right" style="width:200px;" style ="margin: 0px">			
				<!-- Register Form -->
				<!--<form action="#" method="post">
					<h1>Зарегистрироваться</h1>		
					<label class="grey" for="signup">Логин:</label><br/>
					<input class="field" type="text" name="signup" id="signup" value="" size="23" />
					
					<label class="grey" for="pass">Пароль:</label><br/>
					<input class="field" type="text" name="pass" id="pass" value="" size="23" />
					
					<label class="grey" for="email">E-Mail:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					
					<label>Быстрая Регистрация</label>
					<input type="submit" name="submit"  value="Регистрация"   class="button normal white" />
				</form>
			</div> -->
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
		margin-left:10px;
		width:50px;
		height:50px;
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