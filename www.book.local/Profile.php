<?php  
$email = $_POST['email'];
$town = $_POST['town'];
$pol = $_POST['pol'];
$years = $_POST['years'];


$email = strip_tags($email);
$town = strip_tags($town);
$pol = strip_tags($pol);
$years = strip_tags($years);
$login = strip_tags($login);
//Запись данных в БД
	$mysqli = new mysqli ("localhost","root","","GuestBook");
	
      $mysqli -> query ("SET CHARSET 'utf8'");
	  $login = $_POST['login'];
	 $q = "UPDATE RegUsers 
	       SET
		   mail = '$email', 
		   town = '$town', 
		   pol = '$pol', 
		   years = '$years'
		   WHERE Log='$login'";
     $success = $mysqli -> query ("$q");
    if($success == 1){$mysqli -> close ();}
	?>
	
	
<body style="background: url(Background.jpg)">
<style>
.main{
	border-style:groove; 
	display:block; 
	width:700px;
	height:500px; 
	margin-left:400px; 
	background-color:rgba(0, 0, 0, 0.7);
	color:white;
	 align:center;
}
</style>

<div align="center" style="color:white; padding-top:20px;">
<h1>.::Wellcome to GuestBook::.</h1>
</div>




<div class="main">

<?php
//Лог учетки ток админ

    //$login = 'admin';
	
	$link = mysqli_connect("localhost", "root", "", "GuestBook");
	/////////////////////////////////////////////////////////////////////////////////////////////////
	$q = "SELECT Log, Pass, mail, town, pol, years FROM `RegUsers` WHERE Log='$login'";;

	mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    mysqli_query($link, "SET CHARACTER SET 'utf8'");

	if (mysqli_multi_query($link, $q)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link)) {
            $row = mysqli_fetch_row($result);
				
				if($row[2] == null){$row[2]="Не указанно";}
				if($row[3] == null){$row[3]="Не указанно";}
				if($row[4] == null){$row[4]="Не указанно";}
				if($row[5] == null){$row[5]="Не указанно";}
				
				//Условие не работает тк перебор всё равно найдёт админа и выведет. Необходимо редактировать и другие учётки!
				if($row[0] == $login){
                printf("<div align='center' style='color:white;font-size:20px;'> 
         				Изменение учётных данных <br><br>
						<form  action='#' method='post'> Логин:  <input   value='%s' type='text' name='login' maxlength='40' size='20'>
						<br>Добро пожаловать <h1>%s</h1> 
						Введите ваши новые учётные данные:<br><br>
						Email:  <input  value='%s' type='text' name='email' maxlength='40' size='20'><br><br> 
						Город:  <input  value='%s' type='text' name='town' maxlength='40' size='20'><br><br> 
						Пол: %s <input  type='radio' name='pol' value='М'>M <input type='radio' name='pol' value='Ж'>Ж <br><br> 
						Возраст: %d <input  type='number' name='years'><br><br> 
						<a href='index.php'> Назад </a> 
						<input type='submit' value='Сохранить'>  </form> </div>",
				$row[0],$row[0],$row[2],$row[3],$row[4],$row[5]);}
            
            mysqli_free_result($result);
        }else { echo "Ничего не найдено";}
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}


?>

</div>


</body>