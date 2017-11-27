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