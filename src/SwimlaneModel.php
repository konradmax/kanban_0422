<?php

namespace Max\Dashboard;

use Max\Dashboard\Entity\TaskEntity;
use \PDO;

class SwimlaneModel
{

    function getTasksByUserAndStatus($user_id,$status) {

    $pdo = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);

    // prepare sql statement
    $sql = sprintf('SELECT * FROM tasks WHERE user_id=%d AND status=%d',
        $user_id,
        $status
    );
    $sth = $pdo->prepare($sql);
    $sth->execute();

    $result = $sth->fetchAll();

    $output = [];

    foreach($result as $item) {
        $output[] = new TaskEntity($item);
    }

    return $output;
}

    function getTasksByUserAndStatusWithComments($user_id,$status)
    {
        // dla kazdego zadania pobierz komentarze
        $listaZadan = $this->getTasksByUserAndStatus($user_id,$status);
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

        $pdo = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);

        // prepare sql statement
        $sql = sprintf('SELECT * FROM comments WHERE task_id=%d LIMIT 3',
            $task_id
        );
        $sth = $pdo->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();
        $output = [];

        foreach($result as $item) {
            //$output[] = new Comment($item);
        }

        return $output;
    }

    function getCommentsByTaskIdAndUserId($task_id,$user_id) {

        $pdo = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);

        // prepare sql statement
        $sql = sprintf('SELECT * FROM comments WHERE task_id=%d AND user_id=%d LIMIT 3',
            $task_id,
            $user_id
        );
        $sth = $pdo->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;

    }


}

