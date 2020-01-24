<?php
include "../engine/Autoload.php";

use app\interfaces\IModel;
use app\models\{Products, Users, Model, Baskets, Orders};
use app\engine\{Autoload, Db};

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Products();
$user = new Users();
$basket = new Baskets();
$order = new Orders();

function foo(IModel $model) {
    var_dump($model instanceof Model);
}

echo $product->getOne(1) . '</br>';
echo $user->getOne(2) . '</br>';
echo $basket->getOne(3) . '</br>';
echo $order->getOne(4) . '</br>';

//echo $product->getAll();

