<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel {
    protected $db;
    public $id;

    public function __construct(){
        $this->db = Db::getInstance();
    }

    //TODO Переделать, что бы метод не возвращал объект класса, а изменял объект, вызвавший его.
    public function getOne($id){
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->queryOne($sql, ['id' => $id], get_class($this));
    }

    public function getAll(){
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->queryAll($sql);
    }

    public function insert() {
        $keys = "";
        $values = [];

        foreach ($this as $key=>$value) {
            if ($key != 'id' && $key != 'db') {
                $keys .= "{$key}, ";
                $values[] = $value;
            }
        }
        $keys = mb_substr($keys, 0, -2);
        $valuesStr = mb_substr(str_repeat("?, ", count($values)), 0, -2);

        $sql = "INSERT INTO `{$this->getTableName()}` ({$keys}) VALUES ({$valuesStr})";

        $this->db->execute($sql, $values);

        $this->id = $this->db->lastInsertId();
    }

    public function delete() { 
        $sql = "DELETE FROM `{$this->getTableName()}` WHERE `id` = :id";
        $this->db->execute($sql, ['id' => $this->id]);
    }

    public function update() {
        $output = '';
        $values = [];

        foreach ($this as $key=>$value) {
            if ($key != 'id' && $key != 'db') {
                $values[":{$key}"] = $value;
                $output .= "`{$key}` = :{$key}, ";
            }
        }
        $values[':id'] = $this->id;

        $output = mb_substr($output, 0, -2);

        $sql = "UPDATE `{$this->getTableName()}` SET {$output} WHERE `id` = :id";

        var_dump($sql);
        var_dump($values);
        $this->db->execute($sql, $values);
    }

    abstract public function getTableName();
}