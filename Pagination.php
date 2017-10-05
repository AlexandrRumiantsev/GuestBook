<?
$first_name = $_POST['first_name'];
//$Date = $_POST['Date'];
$Email = $_POST['E-Mail'];
$active= $_GET['page'];
if($active == null){$active = 1;} else $active= $_GET['page'];

//Попытка реализации сортировки через условия в запросе, Сам запрос работает, но условие выдаёт ошибку.
// if($first_name == 'Иван'){echo $first_name; $query = 'SELECT * FROM Users WHERE Users = "Иван"';}
// else
//$query = 'SELECT * FROM Users WHERE Users = "Иван"';

//Реализация сортировки
if($first_name != null and $Email != null){$query  = "SELECT * FROM `Users` WHERE Users='$first_name'";}
else if($Email != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email != null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email' and Users='$first_name'";}
else if($Email != null and $first_name == null) {$query  = "SELECT * FROM `Users` WHERE  Mail='$Email'";}
else if($Email == null and $first_name != null) {$query  = "SELECT * FROM `Users` WHERE  Users='$first_name'";}
else $query  = 'SELECT * FROM Users LIMIT '.(($active*5)-5).",5";

        //$query  = 'SELECT * FROM Users LIMIT '.(($active*25)-25).",25";
$stmt = mysqli_prepare($link, $query);

/////////////Число строк\\\\\\\\\\\\\\\\\\\ 
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$countString = mysqli_stmt_num_rows($stmt);




if (mysqli_multi_query($link, $query)) {
    do {
        /* получаем первый результирующий набор */
        if ($result = mysqli_store_result($link)) {
			
            while ($row = mysqli_fetch_row($result)) {
				// тут выводит столбцы из таблицы


				?> <div style="border-style:groove; width:900px; height:300px; background:black; color:white;  background-color:rgba(0, 0, 0, 0.5); padding-bottom:20px;margin-bottom:10px;">
                        <?
                printf("<div  style='float:left; position:relative;'> %s </div>", $row[0]);

				printf("<div style='float:right'> %s </div>", $row[4]);
				printf("<br>"); 
				printf("<br>"); 
				printf("<br>");
                    if($row[5] != null) {
                        printf("<p style='display:block; padding-left:100px; width:400px; float:left; word-wrap: break-word;'>%s</p><img style='width:300px; height:200px; padding-left:0px;' src='source\%s'>", $row[1], $row[5]);
                    }else printf("<p style='display:block; padding-left:200px; width:100px; float:left; align:center;'>%s</p><br><br><br><br><br><br><br><br><br><br><br>",$row[1]);

				 printf("<br>");
				 printf("<br> <br>");

                        ?>  <?
                    printf("<a target='_blank' href='DelPost.php?nameDel=$row[0]&textDel=$row[1]' style='float:left;'> <img width='30px' height='30px' src='images\close.png'></a>");
                    printf("<a target='_blank' href='RedactPost.php?name=$row[0]&text=$row[1]' style='float:left;'> <img width='30px' height='30px' src='edit.png'></a>");
                        ?> </div> <?


            }
            mysqli_free_result($result);
        }
        /* печатаем разделитель */
        if (mysqli_more_results($link)) {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($link));
}

/* закрываем соединение */
//mysqli_close($link); 
//.................................... Pagination -->
  /* Входные параметры */
  $count_pages = $countString/5;
  $active = $_GET['page'];
  if($_GET['page']==null) $active = 1;
  $count_show_pages = 3;
  $url = "/index.php";
  $url_page = "/index.php?page=";
  if ($count_pages > 1) { // Всё это только если количество страниц больше 1
    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
    $left = $active - 1;
    $right = $count_pages - $active;
    if ($left < floor($count_show_pages / 2)) $start = 1;
    else $start = $active - floor($count_show_pages / 2);
    $end = $start + $count_show_pages - 1;
    if ($end > $count_pages) {
      $start -= ($end - $count_pages);
      $end = $count_pages;
      if ($start < 1) $start = 1;
    }
?>
  <!-- Дальше идёт вывод Pagination -->
  <div id="pagination">
    <span style="color:white;">Страницы: </span>
    <?php if ($active != 1) { ?>
      <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
      <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
      <?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    
      <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
      <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
      <?php } ?>
  </div>

<!-- END Pagination -->
<br>

</div>