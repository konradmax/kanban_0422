<?php
require_once('ProductDataStore.php');
require_once('View.php');
require_once('SwimlaneModel.php');

class Controller {

    /**
     * @var View
     */
    protected $view;

    /**
     * @var ProductDataStore
     */
    protected $data_store;

    /**
     * @var string
     */
    protected $source_file;

    public function __construct()
    {
        $this->view = new View();
    }

    public function products()
    {
        $content['page_title'] = "Our Products.";
        $content['content'] = "List of products:";

        $content['products'] = $this->data_store->findAll();

        return $this->view->setContent($content)->render("products");
    }

    public function home()
    {
        $content['page_title'] = "Welcome!";

        return $this->view->setContent($content)->render("home");
    }

    public function swimlanes()
    {

        if(isset($_GET['action'])
            && $_GET['action']=='update') {
            // form has been submitted
            if(isset($_POST['form_name'])&&$_POST['form_name']==="swimlane_update") {
                // user sent swimlane form
                // echo "<pre>"; var_dump($_POST);die();

                if(isset($_POST["zadanie"])) {
                    foreach($_POST["zadanie"] as $zadanieId=>$statusId){
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
//            var_dump($pdo->query($sql));
                        }
                    }
                }
            }

        }

        $swimlaneModel = new SwimlaneModel();

        $swimlanes = $swimlaneModel->getTasksByUserAndStatus(1,1);

        var_dump($_POST);

        $content['page_title'] = "updateSwimlane!";
        $content['swimlanes'] = $swimlanes;
        $content['swimlaneModel'] = $swimlaneModel;

        return $this->view->setContent($content)->render("swimlane");
    }

    public function login() {

        if(isset($_POST)
            && is_array($_POST)
            && ! empty($_POST['uzyszkodnik'])
            && ! empty($_POST['password'])
            && strlen($_POST['password']) > 3
            && array_key_exists('form_name',$_POST)
            && $_POST['form_name']==='login') {
            // user submitted login form
            $username1 = $_POST['uzyszkodnik'];
            $password = $_POST['password'];

            // create database object
            $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

            // prepare sql statement
            $sql = sprintf('SELECT * FROM users WHERE username="%s" AND password="%s" LIMIT 1 ',
                $username1,
                $password
            );

            $currentUserData = $pdo->query($sql)->fetch();
            // check if there are any rows
            if(count($currentUserData)) {
                // username and password are OK. Carry on.

                $_SESSION['user_id'] = $currentUserData['id'];
                $_SESSION['zalogowany'] = 1;


                header('Location: http://localhost/');
                exit;

            } else {
                // username or password incorrect

            }

        }
        $content['page_title'] = "Login";
        $content['form_name'] = "login";

        return $this->view->setContent($content)->render("form-login");

    }
    public function logout() {
        $_SESSION['zalogowany']=0;

        header('Location: http://localhost/');
        exit;

    }

}