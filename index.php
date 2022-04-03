<?php


session_start();
# Sesja musi wystartowac
//if ($_SESSION['zalogowany'] == 1):
    require_once("lib/tasks.php");
//endif;




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
//   $sql = 'SELECT * FROM user WHERE username="'.$username1.'" AND password="'.$password.'" LIMIT 1 ';
    $sql = sprintf('SELECT * FROM users WHERE username="%s" AND password="%s" LIMIT 1 ',
       $username1,
       $password
   );

   // check if there are any rows
   $count = $pdo->query($sql)->rowCount();
    if($count) {
    // username and password are OK. Carry on.

        $_SESSION['uzyszkodnik'] = $username1;
        $_SESSION['zalogowany'] = 1;

    } else {
        // username or password incorrect

    }

}

#ZMIEN HASLO
if($_SESSION['zalogowany']==1) {
    // zalogowany5
    $listaZadan = getTasksByUserAndStatus($_SESSION['uzyszkodnik'],1);
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
