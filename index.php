<?php

require __DIR__ . '/vendor/autoload.php';

use Max\Dashboard\Application;
use Max\Dashboard\Utilities;
use Symfony\Component\Dotenv\Dotenv;
use Laminas\Config\Reader\Json;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');


$session = Utilities::startSession();

$reader = new Json();
$config   = $reader->fromFile(__DIR__.'/config/config.json');

$app = new Application($config);
$html = $app->dispatch();

echo $html;