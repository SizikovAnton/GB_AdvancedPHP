<?php

namespace app\models;

class Users extends DbModel
{
    public $id;
    public $login;
    public $pass;

    public $props = [
        'login' => false,
        'pass' => false
    ];

    public function __construct($params) {
        parent::__construct($params);
    }

    public static function getTableName()
    {
        return "users";
    }

}