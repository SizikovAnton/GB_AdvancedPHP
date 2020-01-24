<?php

namespace app\models;

class Baskets extends Model {
    public $id;
    public $session;
    public $products; //массив с экземплярами класса Products
    public $totalPrice;
    public $count;

    public function getTableName()
    {
        return "baskets";
    }
}