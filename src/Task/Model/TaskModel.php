<?php

namespace Max\Dashboard\Task\Model;

use Max\Dashboard\Common\Model\CommonModel;
use Max\Dashboard\Entity\TaskEntity;

class TaskModel extends CommonModel
{
    protected $table_name = "tasks";

    protected $statuses = [1,2,3,4];

    public function updateTaskStatus($zadanieId,$statusId){
        return $this->updateById($zadanieId,['status'=>$statusId]);
    }

    function getTasksByUser($user_id) {

        $result = $this->readAll(['user_id'=>$user_id]);

        $output = [];
        foreach($result as $item) {
            $output[] = new TaskEntity($item);
        }

        return $output;
    }

    public function getTasksByUserGroupByStatus($user_id)
    {
        $tasks = $this->getTasksByUser($user_id);

        $output = [];

        if( ! empty($tasks)) {
            foreach($tasks as $task) {
                $output[$task->status][$task->id] = $task;
            }
        }

        if(count($this->statuses)!==count($output[$task->status])) {
            foreach($this->statuses as $status) {
                if( ! array_key_exists(intval($status),$output)) {
                    $output[$status] = null;
                }
            }
        }

        return $output;
    }


    function getTasksByUserWithComments($user_id,$status)
    {
        // dla kazdego zadania pobierz komentarze
        $listaZadan = $this->getTasksByUser($user_id,$status);
        if(count($listaZadan)>0) {
            foreach($listaZadan as $index=>$pojedynczeZadanie) {

                $kommentarze = $this->getCommentsByTaskId($pojedynczeZadanie->id);
                $listaZadan[$index] = $pojedynczeZadanie->attachComments($kommentarze);

                $listaZadan[$index]->comments =$this->getCommentsByTaskId($pojedynczeZadanie->id);
            }
        }

        return $listaZadan;
    }

    function getCommentsByTaskId($task_id) {

        return false;
    }

    function getCommentsByTaskIdAndUserId($task_id,$user_id) {

        return false;

    }
}