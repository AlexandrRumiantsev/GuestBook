<?
include 'cookie.inc.php';
include 'setting.php';
require_once  'MyFramework\OneCollection.php';
//Авторизация
global $Login;
global $mail;

$Login=$_POST['log'];
$Password=$_POST['pwd'];

if($_SERVER['REQUEST_METHOD']=='POST'){
	$autori = new autorUser();
	$autori ->auto($Login,$Password);
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
	<script src="js/slide.js" type="text/javascript"></script>