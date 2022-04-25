<?php

namespace Max\Dashboard\User\Model;

use Max\Dashboard\Common\Model\CommonModel;

class UserModel extends CommonModel
{
    protected $table_name = "users";

    public function checkIfUserExistsByUsername($username)
    {
        return $this->read(['username'=>$username]);
    }
}