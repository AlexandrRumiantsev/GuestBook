<?
//Классы для работы с БД
class sqlSort
{
  function sqlSort($Email,$first_name,$active){
      if($first_name != null and $Email != null){
            return $query  = "SELECT * 
            FROM `Users` WHERE Users='$first_name'";}
        else if($Email != null) {
            return $query  = "SELECT * 
            FROM `Users` WHERE  Mail='$Email'";}
        else if($Email != null and $first_name != null) {
            return $query  = "SELECT `Users`.* ,`RegUsers`.* 
            FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log`WHERE  Mail='$Email' and Users='$first_name'";}
        else if($Email != null and $first_name == null) {
            return $query  = "SELECT `Users`.* ,`RegUsers`.* 
            FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Mail='$Email'";}
        else if($Email == null and $first_name != null) {
            return $query  = "SELECT `Users`.* ,`RegUsers`.* 
            FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` WHERE  Users='$first_name'";}
        else return $query  = 'SELECT `Users`.* ,`RegUsers`.* 
            FROM `Users` LEFT JOIN `RegUsers` ON `Users`=`Log` LIMIT '.(($active*3)-3).",3";
    }
}
class connectToBD
{
    private $log;
    private $password;
    private $table;
    var $host =  'localhost';

    //Устанавливаю геттер и сеттер для Логина, Пароля и Таблицы.
    public function getLog(){return $this->log;}
    public function setLog($log){$this->log = $log;}

    public function getPass(){return $this->password;}
    public function setPass($password){$this->password = $password;}

    public function getTable(){return $this->table;}
    public function setTable($table){$this->table = $table;}

    function connect($sql){
        $link = mysqli_connect($this->host, $this->log, $this->password, $this->table);
         //русскоязычный вывод из БД
        mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
        mysqli_query($link, "SET CHARACTER SET 'utf8'");
        return $mysqliResult = mysqli_query($link, $sql);
    }
}
//////////////////////////////////////////////////////////////////////////////////
class Library extends connectToBD
{
    /**
     * Краткое описание функции
     * Функция подсчитывает кол-во сообщений пользователя в бд и выводит на форму
     */
public function Timer($login)
    {
        $log = new connectToBD();
        $log->setLog('root');
        $log = $log->getLog();
        $password = new connectToBD();
        $password->setPass('');
        $password = $password->getPass();
        $table = new connectToBD();
        $table->setTable('GuestBook');
        $table = $table->getTable();

        $link = mysqli_connect($this->host, $log, $password, $table);
        $query = "SELECT * FROM `Message` WHERE  toUser='$login'";
        $mysqliBase = mysqli_query($link, $query);
        return $num_rows  = mysqli_num_rows($mysqliBase);
    }
};

class Message
{
    /**
     * Краткое описание функции
     * Функция для более читабельной передачи данных с блока на форму профиля
     */
    public function formUser($row0, $row2, $row3, $row4, $row5, $row6, $row7, $row8, $row9, $row10, $row11, $row12, $row13, $row14, $Login,$pic)
    {
        $str = "ProfileUsers.php?
    name=$row0&
    un2=$row2&
    un3=$row3&
    un4=$row4&
    un5=$row5&
    un6=$row6&
    un7=$row7&
    un8=$row8&
    un9=$row9&
    un10=$row10&
    un11=$row11&
    un12=$row12&
    un13=$row13&
    un14=$row14&
    un15=$Login&
    pic=$pic";
        return $str;
    }
}

class fileToDirect
{
    public function save_source_code($file,$fileTmp)
    {
        $path = "source/".$file;
        move_uploaded_file($fileTmp, $path);
    }
}

class audit
{
    public function auditType($type){
        if($type == 'text/plain') {echo "Ввод текстового файла на данный момент не реализован!";}
        if ($type == "image/gif" or
            $type == "image/jpeg" or
            $type == "image/jpg" or
            $type == "image/png" or
            $type == 'text/plain' or
            $type == Null) {}
        else {
            echo "Не корректный тип файла!";
            exit();}}

    public function auditSize($size){
        if($size < 1048576)
        {}else{echo"Не допустимый вес файла!";exit();}
    }
}

class userInfo extends connectToBD
{

 function userInfo($Login){
     $user = [
         "userIp" => $_SERVER["REMOTE_ADDR"],
         "userLanguage" => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
         "timeIn" => date(DATE_RFC822),
         "fromIn" => $_SERVER["HTTP_REFERER"],
         "login" => $Login
     ];
     if($Login == null){$Login = "Guest".$user["userIp"];}
     //else $Login  = $user["login"];
     $userIp =$user["userIp"];
     $userLanguage =$user["userLanguage"];
     $timeIn =$user["timeIn"];
     $fromIn =$user["fromIn"];
     $log = new connectToBD();
     $log->setLog('root');
     $log = $log->getLog();
     $password = new connectToBD();
     $password->setPass('');
     $password = $password->getPass();
     $table = new connectToBD();
     $table->setTable('GuestBook');
     $base = $table->getTable();
     $sql ="INSERT INTO usersInfo (userIp,userLanguage,timeIn,fromIn,userLog) VALUES 
                             ('$userIp','$userLanguage','$timeIn','$fromIn','$Login')";
     $link = mysqli_connect($this->host, $log, $password, $base);
     mysqli_query($link, $sql);
     }
    function userStep(){
    }
}

class pagination
{
    function paginationEnter($count_pages, $active, $count_show_pages, $url,$url_page){

if ($count_pages > 1) {
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
///////////////////////////////////////////////////////////////////////////
?>
<!-- Дальше идёт вывод Pagination -->
<div id='loader' style='position: absolute;padding-left:365px;display: none'><img src='images/loader.gif' /></div>
<div id="pagination" style="font-size: 23px;">
    <span style="color:white;">Страницы: </span>
    <?php if ($active != 1) { ?>
        <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
        <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
    <?php } ?>
    <?php for ($i = $start; $i <= $end; $i++) { ?>
        <?php if ($i == $active) { ?><span style="background: white;border-radius: 5px;font-size: 28px;"><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?>
    <?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
    <?php } ?>
    <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
    <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
    <?php } ?>
</div>
    <?php }}

/**
 * Краткое описание класса
 * тут храню все запросы, у всех тип protected
 *
 * Подробное описание класса
 * которое может растянуться на несколько строк с использованием HTML тегов.
 * Теги можно использовать следующие:
 * <b> — жирное начертание;
 * <code> — код;
 * <br> — разрыв строки;
 * <i> — курсив;
 * <kbd> — сочетание клавиш;
 * <li> — элемент списка;
 * <ol> — нумерованный список;
 * <p> — абзац;
 * <pre> — форматированный текст;
 * <samp> — пример;
 * <ul> — маркированный список;
 * <var> — имя переменной.
 * Инлайн тег. Использует данные с {@link http://кодер.укр/data.php}
 * Далее будет список используемых тегов
 *
 * @author Coder UA <web@кодер.укр>
 * @version 1.0
 * @package MyPackageName
 * @category MyCategoryNews
 * @todo описание необходимых доработок
 * @example http://кодер.укр/example.php
 * @copyright Copyright (c) 2014, Coder UA
 */
?>