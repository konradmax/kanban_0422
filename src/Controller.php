<?php

namespace Max\Dashboard;

use Max\Dashboard\ProductDataStore;
use Max\Dashboard\TaskModel;
use Max\Dashboard\Utilities;
use Max\Dashboard\View;
use Max\Dashboard\User\Model\UserModel;
use \PDO;
use Max\Dashboard\Auth\Service\AuthService;

//require_once 'templates/form-new_task.php';


class Controller {

    /**
     * @var View
     */
    protected $view;
    protected $userModel;
    protected $authService;

    /**
     * @var ProductDataStore
     */
    protected $data_store;
    protected $utilities;



    /**
     * @var string
     */
    protected $source_file;

    public function __construct()
    {
        $this->view = new View();
        $this->userModel = new UserModel();
        $this->utilities = new Utilities();
        $this->authService = new AuthService();
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


        if( $_SERVER['REQUEST_METHOD'] === 'POST'
            && array_key_exists('id',$_GET)
            && $_GET['id']>0) {
            // user posted data
            $zadanieId=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
            #TODO: form validation

            // generate new filename for image
            if(is_uploaded_file($_FILES['image']['tmp_name'])) {
                $r = explode(".", $_FILES['image']['name']);

                $newExt = end($r);
                $newFilename = $this->generateRandomString() . '.' . $newExt;
                // move uploaded file
                $fileTmp = $_FILES['image']['tmp_name'];
                move_uploaded_file($fileTmp,'./img/'.$newFilename );
            } else {
                $newFilename = false;
            }


            $sql = sprintf('SELECT * FROM tasks WHERE id=%d LIMIT 1 ',
                $zadanieId
            );

            $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

            $query = $pdo->query($sql);
            $count = $query->rowCount();
            if($count!=0) {
                $result = $query->fetch();

            }

            $changed = false;

            $inputChange = ['title','description','status'];

            // check if any data have been changed
            foreach($inputChange as $inputName) {
                if( isset($_POST[$inputName])
                    && isset($result[$inputName])
                    AND $_POST[$inputName]!==$result[$inputName]
                ) {
                    $changed[$inputName] = $_POST[$inputName];
                }
            }

            if($changed) {
                // sql update
                $i=0;
                $sql = "UPDATE tasks SET  ";

                foreach($changed as $changedInputName => $changedInputValue) {
                    if($i!==0) { $sql .=",";}
                    $sql .= " " . $changedInputName.'="'. $changed[$changedInputName] .'"';
                    $i++;
                }
                if($newFilename) {
                    $sql .= ", image='" . $newFilename . "'";
                }

                $sql .= " WHERE id=" . $zadanieId;

                $pdo->query($sql);

                $_SESSION['messages'][] = "Dane zostaly zaktualizowane.";
                header('Location: http://localhost/dashboard?page=swimlanes');
                exit;
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
            $pdo = new PDO($_SERVER['DB_DSN'], $_SERVER['DB_USER']);

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

    public function login() {
        if(isset($_POST)
            && is_array($_POST)
            && ! empty($_POST['uzyszkodnik'])
            && ! empty($_POST['password'])
            && strlen($_POST['password']) > 3
            && array_key_exists('form_name',$_POST)
            && $_POST['form_name']==='login')
        {
            // user submitted login form
            $username = filter_var($_POST['uzyszkodnik'],FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

            $isAuthValid=$this->authService->authenticate($username,$password);

            if($isAuthValid) {
                $this->authService->login($isAuthValid['id'],$isAuthValid['username'],);
                $this->utilities->addMessage("Zalogowano pomyslnie.");
                Utilities::redirect();
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

    public function newuser() {
        if (isset ($_POST)
            && array_key_exists('form_name',$_POST)
            && $_POST['form_name']==='new_user')
        {
            if(array_key_exists('password', $_POST)
                && array_key_exists('original', $_POST['password'])
                && strlen($_POST['password']['original'])>3
                && array_key_exists('confirm', $_POST['password'])
                && $_POST['password']['confirm'] === $_POST['password']['original']
                && array_key_exists('name', $_POST)
                && strlen($_POST['name'])>2
            ){
                // Form seems to be valid

                $name = $_POST['name'];
                $pass = $_POST['password']['original'];

                // create database object
                $pdo = new PDO('mysql:host=localhost;dbname=test', 'root');

                // prepare sql statement
                $sql = sprintf('INSERT INTO users (id, username, password, status) VALUES (NULL, "%s" , "%s", 1)',
                    $name,
                    $pass
                );
                $pdo->query($sql);

                $_SESSION['messages'][]="Account Created";
                header('Location: http://localhost/dashboard/?page=login',true,302);
                exit;
            }


        }
        $content['page_title'] = "Create Account";
        $content['form_name'] = "new_user";


        return $this->view->setContent($content)->render("form-new_user");

    }



}


