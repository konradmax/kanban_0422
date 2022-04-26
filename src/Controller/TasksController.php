<?php

namespace Max\Dashboard\Controller;

use Max\Dashboard\Auth\Service\AuthService;
use Max\Dashboard\ProductDataStore;
use Max\Dashboard\Task\Model\TaskModel;
use Max\Dashboard\Utilities;
use Max\Dashboard\View;
use \PDO;

class TasksController
{

    protected $view;
    protected $utilities;
    protected $taskModel;
    protected $authService;

    public function __construct()
    {
        $this->view = new View();
        $this->utilities = new Utilities();
        $this->taskModel = new TaskModel();
        $this->authService = new AuthService();
    }

    public function index()
    {
        $currentUserId = $this->authService->getCurrentUserId();
        $swimlanes = $this->taskModel->getTasksByUser($currentUserId);

        $content['page_title'] = "updateSwimlane!";
        $content['tasks'] = $this->taskModel->getTasksByUserGroupByStatus($currentUserId);
        // check for messages
        $content['messages'] = $this->utilities->getMessages();
        $this->utilities->unsetMessages();

        return $this->view->setContent($content)->render("swimlane");
    }

    public function update() {
        if( isset($_GET['action'])
            && $_GET['action']=='update') {
            // form has been submitted
            if(isset($_POST['form_name'])&&$_POST['form_name']==="swimlane_update") {
                // user sent swimlane form

                if(isset($_POST["zadanie"])) {
                    foreach($_POST["zadanie"] as $zadanieId=>$statusId){

                        $zadanieId=filter_var($zadanieId,FILTER_SANITIZE_NUMBER_INT);
                        $statusId=filter_var($statusId,FILTER_SANITIZE_NUMBER_INT);

                        $currentUser=$this->authService->getCurrentUserData();

                        // check if tasks status has changed
                        $tasks = $this->taskModel->read(['id'=>$zadanieId,'status'=>$statusId]);

                        if(empty($tasks)) {

                            $isUpdated = $this->taskModel->updateTaskStatus($zadanieId,$statusId);

                        }
                    }
                }
            }

        }

        return $this->index();
    }

    public function create() {
        if (isset ($_POST['form_name'])){


            $data = [
                "title"=>Utilities::generateRandomString(8),
                "description"=>Utilities::generateRandomString(50),
                "user_id"=>$this->authService->getCurrentUserId(),
                "status"=>1,
                ];

            $this->taskModel->create($data);

//
//            // create database object
//            $pdo = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);
//
//            // prepare sql statement
//            $sql = sprintf('INSERT INTO tasks (`id`, `title`, `description`, `user_id`, `status`) VALUES (NULL, "title", "description", %d, 1 );',
//                $_SESSION['user_id']
//            );
//
//            $pdo->query($sql);
//
//            $content['page_title'] = "Kanban";
//            $content['form_name'] = "new_task";
        }

        Utilities::redirect("?page=swimlanes");
    }

}
