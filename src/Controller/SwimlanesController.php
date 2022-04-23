<?php

namespace Max\Dashboard\Controller;

use Max\Dashboard\ProductDataStore;
use Max\Dashboard\SwimlaneModel;
use Max\Dashboard\Utilities;
use Max\Dashboard\View;
use \PDO;

class SwimlanesController {

    protected $view;
    protected $utilities;

    public function __construct()
    {
        $this->view = new View();
        $this->utilities = new Utilities();
    }

    public function index()
    {
        if(isset($_GET['action'])
            && $_GET['action']=='update') {
            // form has been submitted
            if(isset($_POST['form_name'])&&$_POST['form_name']==="swimlane_update") {
                // user sent swimlane form
                // echo "<pre>"; var_dump($_POST);die();

                if(isset($_POST["zadanie"])) {
                    foreach($_POST["zadanie"] as $zadanieId=>$statusId){
                        $zadanieId=filter_var($zadanieId,FILTER_SANITIZE_NUMBER_INT);
                        $statusId=filter_var($statusId,FILTER_SANITIZE_NUMBER_INT);
                        $sql = sprintf('SELECT * FROM tasks WHERE id=%d AND status=%d LIMIT 1 ',
                            $zadanieId,
                            $statusId
                        );
                        //var_dump($sql); die();

                        $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

                        $count = $pdo->query($sql)->rowCount();
                        if($count==0) {
                            $sql = sprintf('UPDATE tasks SET status = %d WHERE tasks.id = %d;',
                                $statusId,
                                $zadanieId
                            );
                            $pdo->query($sql);


                        }
                    }
                }
            }

        }

        $swimlaneModel = new SwimlaneModel();

        $swimlanes = $swimlaneModel->getTasksByUserAndStatus(1,1);

        $content['page_title'] = "updateSwimlane!";
        $content['swimlanes'] = $swimlanes;
        $content['swimlaneModel'] = $swimlaneModel;
        // check for messages

        $content['messages'] = $this->utilities->getMessages();
        $this->utilities->unsetMessages();

        return $this->view->setContent($content)->render("swimlane");
    }

}
