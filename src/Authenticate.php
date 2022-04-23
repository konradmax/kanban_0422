<?php

namespace Max\Dashboard;

use Max\Dashboard\Utilities;


class Authenticate
{
    public function isAuthenticated(){

        if(array_key_exists('zalogowany',$_SESSION)
            && $_SESSION['zalogowany']===1) {
            return true;
        }

        return false;
    }

    public function login(){}
    public function logout(){}
}
