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

    static public function redirect($location)
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