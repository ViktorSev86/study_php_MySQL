<?php

    //Чтобы русский текст правильно отображался
    error_reporting(-1);
    header('Content-Type: text/html; charset=utf-8');
    mysql_set_charset('utf8');


    echo "Hi"."<br />";
    // Подключение к базе данных
    $mysqli = new mysqli("localhost", "root", "", "mybase");
    $mysqli -> query("SET NAMES 'utf8'");


    // Работа с базой данных

    // Добавление записи в таблицу (добавление пользователя в таблицу Users). Добавится 1 раз, т.к. логин в таблице имеет свойство уникальности
    $success = $mysqli -> query("INSERT INTO `users` (`login`, `password`, `reg_date`) VALUES ('123', '".md5("123")."', '".time()."')");
    echo $success; // Всё ли в порядке

    // Добавление нескольких пользователей в таблицу Users
    for($i = 1; $i < 10; $i++) {
        $mysqli -> query("INSERT INTO `users` (`login`, `password`, `reg_date`) VALUES ('$i', '".md5("$i")."', '".time()."')");
    }

    // Обновление записи в таблице (обновление даты регистрации пользователя)
    $mysqli -> query("UPDATE `mybase`.`users` SET `reg_date` = '123' WHERE `users`.`id` = 5;");

    // Выборка записей из БД
    function print_result($result_set) {
        while (($row = $result_set -> fetch_assoc()) != false) {
            print_r($row);
            echo "<br />";
        }
        echo "Количество строк = ".$result_set -> num_rows."<br />-----------------------<br />";
    }
    $result_set = $mysqli -> query("SELECT * FROM `users`"); // Выбор всех записей из БД
    print_result($result_set);
    $result_set = $mysqli -> query("SELECT `id`, `login` FROM `users` WHERE id > 7"); // Выбор логина и пароля для всех где id > 7
    print_result($result_set);
    $result_set = $mysqli -> query("SELECT `id`, `login` FROM `users` WHERE id < 8 ORDER BY `id` DESC"); // Сортировка по убыванию
    print_result($result_set);
    $result_set = $mysqli -> query("SELECT COUNT(`id`) FROM `users`"); // Количество записей в таблице
    print_result($result_set);

    // Отключение от базы данных
    $mysqli -> close();
?>