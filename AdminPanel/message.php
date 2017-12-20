Сообщения
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel='stylesheet' href='css/style.css' type='text/css' media='screen' />
<div style="margin-top:22px;position: relative;padding-left: 130px;">
<input  type="text" id='ins' placeholder="От кого">
<input  type="text" id='to' placeholder="кому">
<input  type="time" placeholder="время">
<input type="submit" placeholder="найти">
</div>
<br>
<style>
li{list-style-position:inside;}
</style>
<div style="float:left;">

        <?
        //Реализация выпадающего списка имён из БД
        $link = mysqli_connect("localhost", "root", "", "GuestBook");
        $query  = "SELECT * FROM `RegUsers`";
        mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        mysqli_query($link, "SET CHARACTER SET 'utf8'");
        $mBase = mysqli_query($link, $query);

        while($row=mysqli_fetch_assoc($mBase))
        {
            $usFrom = $row["Log"];
            echo "<div style='margin-top:-25px;position:absolute;text-align:center;z-index:100;background:white;color:black;float:right; margin-left:155px; width: 173px;display: none; border-style: groove;' class='spisok'id='$usFrom' data-id='$usFrom'>$usFrom</div>";
            echo "<div style='margin-top:-25px;position:absolute;text-align:center;z-index:100;background:white;color:black;float:right; margin-left:334px; width: 173px;display: none; border-style: groove;' class='spisoks'id='$usFrom' data-id='$usFrom'>$usFrom</div>";
            echo"<br>"; }
        ?>
</div>

<div class='mainCont' style="margin-left:80px;overflow:auto;height: 680px">
<?

$link = mysqli_connect("localhost", "root", "", "GuestBook");
$query  = "SELECT * FROM `Message`";

//Вывод из базы и отображение символов кириллицы
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");

$mysqliBase = mysqli_query($link, $query);

while($row=mysqli_fetch_assoc($mysqliBase)) {
    $text = $row["message"];
    $userFrom = $row["fromUser"];
    $userTo = $row["toUser"];
    $userTime = $row["times"];
    echo "<link rel='stylesheet' href='css/style.css' type='text/css' media='screen' />";
    echo "<div class='blockMess'>От кого:$userFrom Кому:$userTo в:$userTime<hr style='margin: 0px;padding: 0px'> <br> Сообщение: <br>$text<div><hr>
";
}
?>
    </div>
<script>
    $('#ins').focus(function(){
        $('.spisok').show()
    })
    $('.spisok').click(function () {
        var userId = $(this).data('id');
        var div = $('#ins');
        $('#ins').val(userId)
        $('.spisok').hide(0)
        });

    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $('#ins'); // тут указываем класс элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.spisok').hide(0) // скрываем его
        }
    });



</script>

<script>
    $('#to').focus(function(){
        $('.spisoks').show()
    })
        $('.spisoks').click(function () {
            var userId = $(this).data('id');
            $('#to').val(userId)
            $('.spisoks').hide(0)
        })

    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $('#to'); // тут указываем класс элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.spisoks').hide(0) // скрываем его
        }
    });
</script>


