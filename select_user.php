	<? $name = $_POST['first_name'];  ?>
	<body style="background: url(Background.jpg); padding:250px; padding-right:500px;">
	
	<div class="panel panel-default popular-products">
		  <div class="panel-heading" style='color:white; border-style:ridge;'>
			<h3 class="panel-title">Результаты поиска: <b><?php echo "Пользователь: $name"; ?></b></h3>
		  </div>
		  <div class="panel-body">
		  </div>
		</div>
		
		
<?
$name = $_POST['first_name'];
$Date = $_POST['Date'];
$Email = $_POST['E-Mail'];

$Date = date('Y-m-d');

$link = mysqli_connect("localhost", "root", "", "GuestBook");

//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
//=====================================================================================================================================================//
//Условие сортировки по нэйму и майлу
if($name!=null and $Email==null){
$query  = "SELECT * FROM `Users` WHERE Users='$name'";};
if($name!=null and $Email!=null){
$query  = "SELECT * FROM `Users` WHERE Users='$name' and Mail='$Email'";};
if ($name==null and $Email!=null){
$query  = "SELECT * FROM `Users` WHERE Mail='$Email'";};

//Условие сортировки вместе с датой 

/* else if($name!=null and $Email==null and $Date!=null){
$query  = "SELECT * FROM `Users` WHERE Users='$name' and Date='$Date'";}
else if($name!=null and $Email!=null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Users='$name' and Mail='$Email'";}
else if($name==null and $Email!=null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Mail='$Email'";}

else if($name!=null and $Email==null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Users='$name'";}
else if($name!=null and $Email!=null and $Date!=null){
$query  = "SELECT * FROM `Users` WHERE Users='$name' and Mail='$Email' and Date='$Date'";}
else if($name==null and $Email!=null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Mail='$Email'";}

else if($name!=null and $Email==null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Users='$name'";}
else if($name!=null and $Email!=null and $Date!=null){
$query  = "SELECT * FROM `Users` WHERE Users='$name' and Mail='$Email'";}
else if($name==null and $Email!=null and $Date==null){
$query  = "SELECT * FROM `Users` WHERE Mail='$Email'  and Date='$Date'";} */

/* else {$query  = "";}; */

/*  //Условие отбора по Дате
else if($name!=null){
$query  = "SELECT * FROM `Users` WHERE Mail='$Email'";} */

//Условие отбора по Мылу
/* if($Date!=null){
$query  = "SELECT * FROM `Users` WHERE Date='$Date'";};  */

 //or  or 
/* запускаем мультизапрос */
if (mysqli_multi_query($link, $query)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link)) {
            while ($row = mysqli_fetch_row($result)) {
				// тут выводит столбцы из таблицы по имени
				if($row[0] == $name){
					printf("<div style='color:white; border-style:ridge;'>");
                printf("<div style='float:left; color:white;'> Пользователь: %s </div> <br>", $row[0]);
				printf("<div style='float:right color:white;'> Дата: %s </div>", $row[4]);
				printf("<br>"); 
				printf("<br>"); 
				printf("<br>"); 
				printf("Сообщение: %s", $row[1]);
				printf("<br>");	
				     printf("</div>");
				};	
            }
            mysqli_free_result($result);
        }else { echo "Ничего не найдено";}
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}
	?>
	
<div class="panel panel-default popular-products">
		  <div class="panel-heading">
			<a href="index.php">На главную </a>
		  </div>
		  <div class="panel-body">
		  </div>
</div>		
</body>