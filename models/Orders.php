<?php

namespace app\models;

class Orders extends Model {
    public $id;
    public $session;
    public $basket; //Экземпляр класса Baskets

    public $user; //Экземпляр класса Users
    //TODO Возможно стоит объединить информацию о доставке в массив.
    public $name;
    public $adress;
    public $telephone;

    public function getTableName()
    {
        return "orders";
    }
}