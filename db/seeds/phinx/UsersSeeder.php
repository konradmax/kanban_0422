<?php

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'id'    => 1,
                'username'    => 'testowy',
                'password'    => 'lubiemaslo',
                'status'    => 1
            ],
        ];

        $posts = $this->table('users');
        $posts->insert($data)
            ->saveData();
    }
}