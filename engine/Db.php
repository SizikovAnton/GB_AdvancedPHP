<?php

namespace app\engine;

class Db
{
    private static $db;

    //Функция возвращает экземпляр класса Db, а если он отсутствует, то создает его.
    public static function getDb() {
        if(is_null(Db::$db)) {
            Db::$db = new Db;
        }
        return Db::$db;
    }
    
    public function queryOne($sql) {
        return $sql;
    }

    public function queryAll($sql) {
        return $sql;
    }
}