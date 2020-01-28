<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class DbModel implements IModel {
    //protected $db;
    //public $id;

    //Хотел сделать конструктор через перегрузку, но как оказалось в php нет перегрузки которую я знаю. 
    //У способа который я сделал есть несколько недостатков и самый главный это требование 
    //к внимательности программиста при передаче аргументов в конструктор. 
    //Если это решение окажется допустимым, подумаю как добавить проверку аргументов.
    //Так же не смог придумать как присвоить создаваемому объекту объект возвращаемый getOne().
    //И еще из минусов, мне пришлось изменить количество аргументов у метода getOne(). 
    public function __construct($params){
        if(is_int($params)) {
            $params = DbModel::getOne($params, $this->getTableName());
        }
        if(is_array($params)) {
            foreach($params as $InKey => $inValue) {
                $this->{$InKey} = $inValue;
            }
        }
        if(!$this->id) {
            foreach($this->props as $key => $value) {
                $this->props["{$key}"] = true;
            }
        }
    }

    public function __set($name, $value)
    {
        $this->props["{$name}"] = true;
        $this->{$name} = $value;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    //FIXME Не смог сделать метод getOne() private или protected, так как в IModel он указан public
    public static function getOne($id, $tableName){
        //$tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryOne($sql, ['id' => $id]);
    }

    public static function getAll(){
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    //TODO Подумать над оптимизацией и добавить проверку, что бы не отправлять пустым.
    public function insert() {
        $keys = "";
        $values = [];

        foreach ($this as $key=>$value) {
            if ($key != 'id' && $key != 'db' && $key != 'props') {
                $keys .= "{$key}, ";
                $values[] = $value;
            }
        }
        $keys = mb_substr($keys, 0, -2);
        $valuesStr = mb_substr(str_repeat("?, ", count($values)), 0, -2);

        $sql = "INSERT INTO `{$this->getTableName()}` ({$keys}) VALUES ({$valuesStr})";

        Db::getInstance()->execute($sql, $values);
        $this->id = Db::getInstance()->lastInsertId();
    }

    public function delete() { 
        $sql = "DELETE FROM `{$this->getTableName()}` WHERE `id` = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    //TODO Подумать над оптимизацией
    public function update() {
        $output = '';
        $values = [];

        foreach ($this as $key=>$value) {
            if ($key != 'id' && $key != 'db' && $this->props["{$key}"]) {
                $values[":{$key}"] = $value;
                $output .= "`{$key}` = :{$key}, ";
            }
        }
        $values[':id'] = $this->id;

        $output = mb_substr($output, 0, -2);

        if(strlen($output)) {
            $sql = "UPDATE `{$this->getTableName()}` SET {$output} WHERE `id` = :id";
            Db::getInstance()->execute($sql, $values);
        }
    }

    public function save() {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    abstract public static function getTableName();
}