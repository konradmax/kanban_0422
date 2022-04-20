<?php


session_start();

require_once("src/Application.php");

$page = !empty($_GET['page']) ? $_GET['page'] : "home";

$app = new Application();
$html = $app->dispatch($page);

echo $html;