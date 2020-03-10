<?php
@session_start();
// Массив доступных для выбора языков
$LangArray = array("ru/main", "en/main");

// Язык по умолчанию
$DefaultLang = "ru/main";

// Если язык уже выбран и сохранен в сессии отправляем его скрипту
if(@$_SESSION['NowLang']) {
	// Проверяем если выбранный язык доступен для выбора
	if(!in_array($_SESSION['NowLang'], $LangArray)) {
		// Неправильный выбор, возвращаем язык по умолчанию
		$_SESSION['NowLang'] = $DefaultLang;
	}
}
 else {
 	$_SESSION['NowLang'] = $DefaultLang;
 }

// Выбранный язык отправлен скрипту через GET
$language = addslashes($_GET['lang']);
if($language) {
	// Проверяем если выбранный язык доступен для выбора
	if(!in_array($language, $LangArray)) {
		// Неправильный выбор, возвращаем язык по умолчанию
		$_SESSION['NowLang'] = $DefaultLang;
	}
	 else {
	 	// Сохраняем язык в сессии
	 	$_SESSION['NowLang'] = $language;
	 }
}
// Открываем текущий язык
$CurentLang = addslashes($_SESSION['NowLang']);
include_once ("lang/".$CurentLang.".php");
?>