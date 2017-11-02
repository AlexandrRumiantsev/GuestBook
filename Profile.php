<?php  
$email = $_POST['email'];
$town = $_POST['town'];
$pol = $_POST['pol'];
$years = $_POST['years'];
$status = $_POST['status'];

$fileX = $_FILES['file'];
$file = $_FILES['file']['name'];
$filePath = "images/" .$file;
//$nameFile = $_POST['file']['name'];
$s = move_uploaded_file ($_FILES["file"]["tmp_name"] ,$filePath);

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
		   years = '$years',
		   ProfPic = '$filePath'
		   WHERE Log='$login'";
     $success = $mysqli -> query ("$q");
    if($success == 1){$mysqli -> close ();}
	?>
	
	
<body style="background: url(Background.jpg)">
<style>
.main{
	border-style:groove; 
	display:block; 
	width:900px;
	height:500px; 
	margin-left:270px;
	background-color:rgba(0, 0, 0, 0.7);
	color:white;
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
	$q = "SELECT Log, Pass, mail, town, pol, years, ProfPic, status FROM `RegUsers` WHERE Log='$login'";;

	mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
    mysqli_query($link, "SET CHARACTER SET 'utf8'");

	if (mysqli_multi_query($link, $q)) {
		do{
			/* получаем первый результирующий набор */
			if ($result = mysqli_store_result($link)) {
				$row = mysqli_fetch_row($result);

				//if($row[2] == null){$row[2]="Не указанно";}
				//if($row[3] == null){$row[3]="Не указанно";}
				//if($row[4] == null){$row[4]="Не указанно";}
				//if($row[5] == null){$row[5]="Не указанно";}

				//Условие не работает тк перебор всё равно найдёт админа и выведет. Необходимо редактировать и другие учётки!
				if ($row[0] == $login) {
					/*printf("<div align='center' style='color:white;font-size:20px;'>
                             Изменение учётных данных <br><br>
                             <div style='float:left;'><img src='%s' style='width: 350px; height: 350px; margin-left: 25px; margin-top: 25px'></div>
                            <div style='float:right';><form  action='#' method='post' enctype='multipart/form-data'> Логин:  <input   value='%s' type='text' name='login' maxlength='40' size='20'>
                            <br>Добро пожаловать <h1>%s</h1>
                            Email:  <input  value='%s' type='text' name='email' maxlength='40' size='20'><br><br>
                            Город:  <input  value='%s' type='text' name='town' maxlength='40' size='20'><br><br>
                            Пол: %s <input  type='radio' name='pol' value='М'>M <input type='radio' name='pol' value='Ж'>Ж <br><br>
                            Возраст: %d <input  type='number' name='years'><br><br>
                            <input  type='file' name='file'  multiple><br><br><br>
                            <a href='index.php'> Назад </a>
                            <input type='submit' value='Сохранить'>  </form> </div> </div>",
                        $row[6],$row[0],$row[0],$row[2],$row[3],$row[4],$row[5]);}*/
					////////////////////////////////////////////////////////////////////////////////////////////
					//first connect
					$picFirst =$_GET['pic'];
					$mailFirst = $_GET['mail'];
					$flameFirst = $_GET['pol'];
					$yearsFirst = $row['years'];
					$townFirst = $_GET['town'];
					///////////////
					global $status;
					$status = $row[7];
					$pic = $row[6];
					$log = $row[0];
					$mail = $row[2];
					$flame = $row[4];
					$years = $row[5];
					$town = $row[3];

					if($pic==null){$pic=$picFirst;}
					$pic=$picFirst;
					if($mail==null){$mail=$mailFirst;}
					if($flame==null){$flame=$flameFirst;}
					$flame=$flameFirst;
					if($years==null){$years=$yearsFirst;}
					$years=$yearsFirst;
					if($town==null){$town=$townFirst;}

					//if($status == 'admin')$adm = "<a href='#'>Админка</a>";
					if($status == 'admin') echo"<a target='_blank' href='AdminPanel\MainAdmin.php'>Админка</a>";
					echo "<div align='center' style='color:white;font-size:20px;'>
                    
         				Изменение учётных данных <br><br>
         		
         				<div style='float:left;'><img src='$pic' style='width: 350px; height: 350px; margin-left: 25px; margin-top: 25px'></div>
						<div><form action='#' method='post' enctype='multipart/form-data'>
						Логин:  <input   value='$log' type='text' name='login' maxlength='40' size='20'>
						<br>Добро пожаловать <h1>$log</h1> 
						Email: $mail <input  value='$mail' type='text' name='email' maxlength='40' size='20'><br><br> 
						Город: $town <input  value='$town' type='text' name='town' maxlength='40' size='20'><br><br> 
						Пол: $flame <input  type='radio' name='pol' value='М'>M <input type='radio' name='pol' value='Ж'>Ж <br><br> 
						Возраст: $years <input  type='number' name='years'><br><br>
						<input  type='file' name='file'  value='$pic'  multiple><br><br><br>
						
						<a href='index.php'> Назад </a>   
						<input type='submit'  onClick='redirect()' value='Сохранить'>  </form> </div> </div>";

					echo"<script type='text/javascript'>
                     function redirect(){
						alert('Данные успешно изменены!');
                     window.location.href = 'index.php';}
                   </script>";

					mysqli_free_result($result);
				} else {
					echo "Ничего не найдено";
				}
			}
		}while (mysqli_next_result($link));
	}
?>
</div>
</body>
