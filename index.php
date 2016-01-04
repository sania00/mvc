<?php

//------FRONT CONTROLLER

//------ОБЩИЕ НАСТРОЙКИ
ini_set('display_errors', 1);
error_reporting(E_ALL);

//------ПОДКЛЮЧЕНИЕ ФАЙЛОВ СИСТЕМЫ
define('ROOT', dirname(__FILE__));
require_once (ROOT. '/components/Router.php');
include_once (ROOT . '/components/Db.php');

//------УСТАНОВКА СОЕДИНЕНИЯ С БД


//------ВЫЗОВ ROUTER
$router = new Router();
$router->run();
