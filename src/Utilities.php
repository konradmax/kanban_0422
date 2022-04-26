<?php


namespace Max\Dashboard;

class Utilities {

    protected $messages;

    static public function startSession() : bool
    {
        if(session_start()){
            return true;
        }

        return false;
    }

    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static public function redirect($location=null)
    {
        header("Location: " . $_SERVER['WEB_ADDR'] . $location,true );
        exit;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function unsetMessages()
    {
        unset($_SESSION['messages']);

        return $this;
    }

    public function addMessage(string $text)
    {
        $this->messages[]=$text;

        return $this;
    }

}