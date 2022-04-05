<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Hello</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/swimlane.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->

    <?php
    if(array_key_exists('zalogowany',$_SESSION)&&$_SESSION['zalogowany']==1):
    ?>
        <link href="assets/css/swimlane.css" rel="stylesheet">
    <?php
    else:
        ?>
        <link href="assets/css/sign-in.css" rel="stylesheet">
    <?php
    endif;
    ?>


</head>
<body class="text-center">

<main <?php if(isset($_SESSION['zalogowany'])&&$_SESSION['zalogowany']==0):?>class="form-signin"<?php endif;?>>

    <?php
    if(array_key_exists('zalogowany',$_SESSION)&&$_SESSION['zalogowany']==1):
        include("swimlane.php");
    else:
        include("form.php");
    endif;
    ?>
</main>


</body>
</html>
