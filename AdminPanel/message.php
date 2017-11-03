Сообщения
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<input  type="text" id='ins' placeholder="От кого">
<input  type="text" id='to' placeholder="кому">
<input  type="time" placeholder="время">
<input type="submit" placeholder="найти">
<br>
<style>
li{list-style-position:inside;}
</style>

<div>

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
            echo "<div class='spisok'id='$usFrom' data-id='$usFrom' style='display: none;'>$usFrom</div>";
        }
        ?>
        <?
        //Реализация 2 выпадающего списка имён из БД
        $link = mysqli_connect("localhost", "root", "", "GuestBook");
        $query  = "SELECT * FROM `RegUsers`";
        mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        mysqli_query($link, "SET CHARACTER SET 'utf8'");
        $mBase = mysqli_query($link, $query);
        while($row=mysqli_fetch_assoc($mBase))
        {
            $usFrom = $row["Log"];
            echo "<div class='spisoks'id='$usFrom' data-id='$usFrom' style='display: none;'>$usFrom</div>";
        }
        ?>

</div>
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
    echo "<br>От кого:$userFrom Кому:$userTo в:$userTime Сообщение:$text<br>";
}
?>
<script>
    $('#ins').focus(function(){
        $('.spisok').show()
    })
    $('.spisok').click(function () {
        var userId = $(this).data('id');
        var div = $('#ins');
        $('#ins').val(userId)
        $('.spisok').hide()

        });

    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $('#ins'); // тут указываем класс элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.spisok').hide() // скрываем его
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
            $('.spisoks').hide()
        })

    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $('#to'); // тут указываем класс элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.spisoks').hide() // скрываем его
        }
    });
</script>


