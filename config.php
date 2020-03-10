<?php
header('Content-Type: text/html; charset=utf-8');

    $config = array
    (        
        'host'	=>	'localhost',	// Хост
        'user'	=>	'root',			// Имя пользователя
        'pass'	=>	'1234',			// Пароль от БД
        'name'	=>	'pw',			// Название БД
        
        'gold'	=>	'100000',	    // Кол-во голда которые будет выдано при регистрации
        
        'LoginMinLeng'  =>  5,      // Минимальная длинна логина
        'LoginMaxLeng'  =>  15,     // Максимальная длинна логина
        
        'PassMinLeng'   =>  5,      // Минимальная длинна пароля
        'PassMaxLeng'   =>  30,     // Максимальная длинна пароля

        'EmailMinLeng'  =>  5,     // Минимальная длинна email
        'EmailMaxLeng'  =>  30,     // Максимальная длинна email
        
        
    );

    $link = mysql_connect(
        $config['host'], 
        $config['user'], 
        $config['pass']
    ) or die ("Нет соединения с MySQL");
    mysql_select_db($config['name'], $link) or die ("Базы <b><font color=red>".$config['name']."</b></font> не существует");

session_start(); 

