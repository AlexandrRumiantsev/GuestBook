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