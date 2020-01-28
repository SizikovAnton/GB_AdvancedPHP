<?php


namespace app\interfaces;

interface IModel
{
    public static function getOne($id, $tableName);
    public static function getAll();
    public static function getTableName();

}