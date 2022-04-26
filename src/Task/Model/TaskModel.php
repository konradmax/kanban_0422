<?php

namespace Max\Dashboard\Task\Model;

use Max\Dashboard\Common\Model\CommonModel;

class TaskModel extends CommonModel
{
    protected $table_name = "tasks";

    public function updateTaskStatus($zadanieId,$statusId){
        return $this->updateById($zadanieId,['status'=>$statusId]);
    }
}