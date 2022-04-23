<?php

require __DIR__ . '/vendor/autoload.php';

use Max\Dashboard\Application;
use Symfony\Component\Dotenv\Dotenv;
use Laminas\Config\Reader\Json;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

session_start();

// deal with routes here
$reader = new Json();
$routesConfig   = $reader->fromFile(__DIR__.'/config/routes.json');

$page = !empty($_GET['page']) ? $_GET['page'] : "home";

if(array_key_exists('page',$_GET)
    && array_key_exists($_GET['page'],$routesConfig)) {
    // load custom controller
    $app = new Application();
    $html = $app->dispatch($page);

} else {
    $app = new Application();
    $html = $app->dispatch($page);
}

echo $html;