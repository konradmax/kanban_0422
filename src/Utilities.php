<?php


namespace Max\Dashboard;

class Utilities {

    static public function startSession() : bool
    {
        if(session_start()){
            return true;
        }

        return false;
    }

}