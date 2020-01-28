<?php
namespace app\models;


class Basket extends DbModel
{
    public $id;
    public $session_id;
    public $goods_id;

    public $props = [
        'session_id' => false,
        'goods_id' => false
    ];

    public function __construct($params) {
        parent::__construct($params);
    }

    public static function getTableName()
    {
        return "basket";
    }

}