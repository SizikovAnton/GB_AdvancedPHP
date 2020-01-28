<?php

namespace app\models;

class Products extends DbModel {
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    public $props = [
        'name' => false,
        'descprition' => false,
        'price' => false
    ];

    public function __construct($params) {
        parent::__construct($params);
    }

    public static function getTableName()
    {
        return "products";
    }


}
