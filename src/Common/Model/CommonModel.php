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

    public function create($data){

    }

    public function read($where=[])
    {
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
        }

        return $this->database->query($sql)->fetch();
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