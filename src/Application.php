<?php

namespace Max\Dashboard;

use Max\Dashboard\Controller;
use Max\Dashboard\View;
use Max\Dashboard\Authenticate;


class Application {

    protected array $config;

    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Dispatch a request and return a string of HTML to be displayed to the client.
     *
     */
    public function dispatch() : string
    {
        $auth = new Authenticate();
        $view = new View();

        $pageGet = !empty($_GET['page']) ? filter_var($_GET['page'], FILTER_SANITIZE_STRING) : "homepage";
        $actionGet = !empty($_GET['action']) ? filter_var($_GET['action'], FILTER_SANITIZE_STRING) : "index";

        if(array_key_exists($pageGet,$this->config['routes'])) {
            // page is declared in config file. There is custom controller.
            if(array_key_exists('restricted',$this->config['routes'][$pageGet])
                && $this->config['routes'][$pageGet]['restricted'] ===true
            ) {
                if( ! $auth->isAuthenticated()) {
                    $_SESSION['message'][] = "Must be logged in.";
                    header('Location: http://localhost/dashboard/?page=login');
                    exit;
                }
            }
var_dump($actionGet);
            $controller = new $this->config['routes'][$pageGet]['controller'];
            if(method_exists($controller,$actionGet)) {
                $content['content'] = $controller->$actionGet();
            } else {
                $content['content'] = $controller->index();
            }
        } else {
            // page will use standard Controller
            $controller = new Controller();
            if( false === method_exists($controller,$pageGet)) {
                // the sprintf() actually helps with debugging. so the admin will report the err-msg
                // with the GET value.
                $content['content'] = sprintf("Status 404 :: Page '%s' not found.",$pageGet);
            } else {
                $content['content'] = $controller->$pageGet();
            }
        }

        return $view->setContent($content)->render();
    }
}
