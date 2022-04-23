<html>
<head>
    <title>Kanban Board v2</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

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
<body>

<nav class="navbar navbar-toggleable-xl navbar-inverse bg-inverse">
    <div class="container">
        <a class="navbar-brand" href="#">Acme Clothing</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="?page=home">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=products">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=adminImportProducts">Import products</a>
            </li>
            <?php
            if(array_key_exists('zalogowany',$_SESSION)&&$_SESSION['zalogowany']==1):
            ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=swimlanes">Swimlanes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=logout">Logout</a>
            </li>
            <?php
                else:
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=newuser">New Account</a>
                </li>

            <?php
                endif;
            ?>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:30px;">
    <?=$content["content"];?>
</div>

</body>
</html>