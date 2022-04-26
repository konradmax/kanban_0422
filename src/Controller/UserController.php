<?php

namespace Max\Dashboard\Controller;

use Max\Dashboard\ProductDataStore;
use Max\Dashboard\TaskModel;
use Max\Dashboard\View;
use \PDO;

class UserController {

    public function __construct()
    {
        $this->view = new View();
    }

    public function index()
    {
        $content['page_title'] = "Welcome!!1!";
        return $this->view->setContent($content)->render("home");
    }
    public function homepage()
    {
        return $this->index();
    }

}
