<html>
<head>
    <title>Acme Clothing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
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
        </ul>
    </div>
</nav>

<div class="container" style="margin-top:30px;">
    <?=$content["content"];?>
</div>

</body>
</html>