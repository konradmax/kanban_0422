<?php

namespace Max\Dashboard;

use Max\Dashboard\Controller;
use Max\Dashboard\View;


class Application {

    /**
     * Dispatch a request and return a string of HTML to be displayed to the client.
     *
     * @param string $page
     * @return string
     * @throws Exception
     */
    public function dispatch(string $page) : string
    {
        $controller = new Controller();
        $view = new View();


        if( false === method_exists($controller,$page)) {
            // the sprintf() actually helps with debugging. so the admin will report the err-msg
            // with the GET value.
            $content['content'] = sprintf("Status 404 :: Page '%s' not found.",$page);
        } else {
            $content['content'] = $controller->$page();
        }

        return $view->setContent($content)->render();
    }
}
