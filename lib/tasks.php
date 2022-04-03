<?php

function getTasksByUserAndStatus($username,$status) {

    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

    // prepare sql statement
//   $sql = 'SELECT * FROM user WHERE username="'.$username1.'" AND password="'.$password.'" LIMIT 1 ';
    $sql = sprintf('SELECT * FROM tasks WHERE username="%s" AND status=%d',
        $username,
        $status
    );
    $sth = $pdo->prepare($sql);
    $sth->execute();

    $result = $sth->fetchAll();

    return $result;

}