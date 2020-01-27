<?php
include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

use app\models\{Products, Users, Basket};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Products();

//$user = new Users();
//var_dump($user->getOne(2));
//$product->insert();
//$product->delete();

//$product->id = 8;

//$product->delete();

//var_dump($product->getOne(3));

//var_dump($product);
//$product = $product->getOne(7);
//var_dump($product);

//var_dump($product->getAll());

//var_dump($product->getAll());

/*$product = $product->getOne(6);
$product->price = 1234;
$product->description = "Очень крепкий";
$product->update();*/