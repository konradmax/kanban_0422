<?php
function getTasksByUserAndStatus($user_id,$status) {

    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

    // prepare sql statement
    $sql = sprintf('SELECT * FROM tasks WHERE user_id=%d AND status=%d',
        $user_id,
        $status
    );
    $sth = $pdo->prepare($sql);
    $sth->execute();

    $result = $sth->fetchAll();

    return $result;
}

function getTasksByUserAndStatusWithComments($user_id,$status)
{
    // dla kazdego zadania pobierz komentarze
    $listaZadan = getTasksByUserAndStatus($user_id,$status);
    if(count($listaZadan)>0) {
        foreach($listaZadan as $index=>$pojedynczeZadanie) {

            $listaZadan[$index]['komentarze'] = getCommentsByTaskId($pojedynczeZadanie['id']);
        }
    }

    return $listaZadan;
}

function getCommentsByTaskId($task_id) {

    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

    // prepare sql statement
    $sql = sprintf('SELECT * FROM comments WHERE task_id=%d LIMIT 3',
        $task_id
    );
    $sth = $pdo->prepare($sql);
    $sth->execute();

    $result = $sth->fetchAll();

    return $result;
}

function getCommentsByTaskIdAndUserId($task_id,$user_id) {

    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

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