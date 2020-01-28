<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);

//TODO Подумать над формированием url в более читаемом виде
$controllerName = $_GET['c'] ?: 'product';
$actionName = $_GET['a'];

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    $controller->runAction($actionName);
} else die("404");




//Блок для проверки конструктора
/*
$product = new Products(6);
var_dump($product);

$product1 = new Products(['name' => 'Тестовое имя', 'description' => 'Тестовое описание', 'price' => '12345']);
var_dump($product1);

//Проверка update
$product->name = "Новое имя2";
$product->save();

$product1->save();

var_dump($product1);*/