<?php

namespace Max\Dashboard\Auth\Service;

use Max\Dashboard\User\Model\UserModel;
use Max\Dashboard\Utilities;

class AuthService
{

    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }


    public function authenticate($username,$password){
        $result = $this->userModel->read(
            [
                'username'=>$username,
                'password'=>$password
            ]);
        return ($result);
    }

    /**
     * Login User
     *
     * @param $id
     * @param $username
     * @return bool
     */
    public function login($id,$username){
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['zalogowany'] = 1;

        return true;
    }

    public function getCurrentUserData()
    {
        return [
            'id' => $_SESSION['user_id'],
            'username'=>$_SESSION['username']
        ];
    }

    public function getCurrentUserId(){
        return $_SESSION['user_id'];
    }
}