<?php


session_start();
# Sesja musi wystartowac
//if ($_SESSION['zalogowany'] == 1):
    require_once("lib/tasks.php");
    require_once("lib/Task.php");
    require_once("lib/Comment.php");
//endif;



if(array_key_exists('name',$_POST)) {
    var_dump($_POST);die();
}

$post = $_POST;
$header = "lubiemaslo";
$formName = "login";

## LOGIN
// some basic validation
if(isset($_POST)
    && is_array($_POST)
    && ! empty($_POST['uzyszkodnik'])
    && ! empty($_POST['password'])
    && strlen($_POST['password']) > 3
) {
    // assign variables from POST to local
    $username1 = $_POST['uzyszkodnik'];
    $password = $_POST['password'];

    // create database object
    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

    // prepare sql statement
    $sql = sprintf('SELECT * FROM users WHERE username="%s" AND password="%s" LIMIT 1 ',
       $username1,
       $password
   );

    $currentUserData = $pdo->query($sql)->fetch();
   // check if there are any rows
    if(count($currentUserData)) {
    // username and password are OK. Carry on.

        $_SESSION['user_id'] = $currentUserData['id'];
        $_SESSION['zalogowany'] = 1;

    } else {
        // username or password incorrect

    }

}

#ZMIEN HASLO
if(array_key_exists('zalogowany',$_SESSION)&&$_SESSION['zalogowany']==1) {

    // zalogowany
    $listaZadan = getTasksByUserAndStatusWithComments($_SESSION['user_id'],1);




    $header = "Zmien haslo";

    $formName = "change_password";


    if(isset($_POST)
        && is_array($_POST)
        && ! empty($_POST['uzyszkodnik'])
        && ! empty($_POST['password'])
        && strlen($_POST['password']) > 3
    ) {

        $username1 = $_POST['uzyszkodnik'];
        $password = $_POST['password'];

        // create database object
        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

        // prepare sql statement
        $sql = sprintf('UPDATE users
        SET password = "%s"
        WHERE username="%s";
        ',
            $password,
            $username1
        );

        // check if there are any rows

        $count = $pdo->query($sql)->rowCount();
        if($count) {
//            echo 'haslo zmienione';

//            var_dump($pdo->query($sql));
        }

    }

    echo "<a href='?akcja=wyloguj' >wyloguj</a>";


    if(isset($_GET['akcja'])
    && $_GET['akcja'] == 'wyloguj'
    ) {

        $_SESSION['zalogowany']=0;

        header('Location: http://localhost/');
        exit;


    }

}

require ("templates/main.php");
//require ("templates/form.php");
