<?
/**
 * Краткое описание функции
 * Функция подсчитывает кол-во сообщений пользователя в бд и выводит на форму
 */
function Timer($login){
     $link = mysqli_connect("localhost", "root", "", "GuestBook");
     $query  = "SELECT * FROM `Message` WHERE  toUser='$login'";
    $mysqliBase = mysqli_query($link, $query);
    return $num_rows = mysqli_num_rows($mysqliBase);
    };

/**
 * Краткое описание функции
 * Функция для более читабельной передачи данных с блока на форму профиля
 */
function formUser($row0,$row2,$row3,$row4,$row5,$row6,$row7,$row8,$row9,$row10,$row11,$row12,$row13,$row14,$Login){
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
    un15=$Login";
    return $str;
};

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