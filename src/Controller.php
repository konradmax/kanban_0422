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

    public function edit() {
        $zadanieId=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

        if( $_SERVER['REQUEST_METHOD'] === 'POST'
            && array_key_exists('id',$_GET)
            && $_GET['id']>0) {
            // user posted data

            $r = explode(".", $_FILES['image']['name']);
            $newExt = end($r);
            $newFilename = $this->generateRandomString() . '.' . $newExt;


//            echo "<pre>";
//            var_dump($_POST);
//            var_dump($_FILES['image']);

            $fileTmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($fileTmp,'./img/'.$newFilename );

            $zadanieId=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
            $sql = sprintf('SELECT * FROM tasks WHERE id=%d LIMIT 1 ',
                $zadanieId
            );
            $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

            $query = $pdo->query($sql);
            $count = $query->rowCount();
            if($count!=0) {
                $result = $query->fetch();

                var_dump($result);
                $result = $result;

            }

            $changed = false;

            $inputChange = ['title','description','status'];

            foreach($inputChange as $inputName) {
                if( isset($_POST[$inputName])
                    && isset($result[$inputName])
                    AND $_POST[$inputName]!==$result[$inputName]
                ) {
                    $changed[$inputName] = $inputName;
                }
            }

            if($changed) {
                // sql update
                $i=0;
                $sql = "UPDATE tasks SET  ";
                foreach($changed as $changedInputName => $changedInputValue) {
                    if($i!==0) { $sql .=",";}

                    $sql .= " " . $changedInputName.'="'. $changedInputValue .'"';
                    $i++;
                }
                if($newFilename) {
                    $sql .= ", image='" . $newFilename . "'";
                }

                $sql .= " WHERE id=" . $zadanieId;

                $pdo->query($sql);


            }

        } elseif(array_key_exists('id',$_GET)
            && $_GET['id']>0) {

            $content['page_title'] = "Edit Item.";
            $content['form_name'] = "form_item_edit";
            $content['content'] = null;


            $zadanieId=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
            $sql = sprintf('SELECT * FROM tasks WHERE id=%d LIMIT 1 ',
                $zadanieId
            );
            $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

            $query = $pdo->query($sql);
            $count = $query->rowCount();
            if($count!=0) {
                $result = $query->fetch();
                $content['result'] = $result;

            }



            // display form
            return $this->view->setContent($content)->render("form-task-item");

        }
        return $this->view->setContent('')->render("form-task-item");


        return 'edit';
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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