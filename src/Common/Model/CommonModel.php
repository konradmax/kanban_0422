<?php

namespace Max\Dashboard\Common\Model;

use Max\Dashboard\Common\Infrastructure\LocalDatabaseRepository;
use \PDO;

class CommonModel
{
    protected $table_name;

    private $database;

    public function __construct()
    {
        $this->database = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);;
    }

    public function create($data)
    {
        $sql = sprintf("INSERT INTO %s ",$this->table_name);
        $sqlColumns = implode(', ',array_keys($data));
        $sql .= sprintf(" (%s)",$sqlColumns);

        $sqlValuesQuoted = array_map(function($val) {
            if( ! is_null($val)) {
                return '"'.$val.'"';
            }
            return $val;
            }, $data);
        $sqlValues = implode(', ',$sqlValuesQuoted);

        $sql .= sprintf(" VALUES (%s)",$sqlValues);

        return $this->database->query($sql);
    }

    public function read($where=[],int $limit=0)
    {
        $sql = $this->readSQL($where,$limit);

        return $this->database->query($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public function readAll($where=[],int $limit=0)
    {
        $sql = $this->readSQL($where,$limit);

        return $this->database->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function readSQL($where=[],int $limit=0) {
        $sql = sprintf("SELECT * FROM %s",$this->table_name);

        if( ! empty($where)) {
            $countColumns = count($where);
            $i=1;
            $sql .= " WHERE ";
            foreach($where as $columnName=>$columnValue) {
                $sql .= sprintf(" %s='%s'",$columnName,$columnValue);
                if($i!==$countColumns) {
                    $sql .= " AND";
                }
                $i++;
            }

            if($limit>0) {
                $sql .= sprintf(" LIMIT %d",$limit);
            }

        }

        return $sql;
    }

    public function readOne($where=[],int $limit=0)
    {
        $result = $this->read($where,$limit);

        return $result[0];
    }


    public function updateById($id,$data){
        $sql = "UPDATE tasks SET ";
        $countColumns = count($data);
        $i = 1;

        foreach($data as $columnName=>$columnValue) {
            $sql .= sprintf(" %s='%s'",$columnName,$columnValue);
            if($i!==$countColumns) {
                $sql .= ", ";
            }
            $i++;
        }

        $sql .= " WHERE id=" . $id;

        return $this->database->query($sql);

    }
    public function delete($id){

    }
    public function deactivate($id){

    }
    public function list(){}

}