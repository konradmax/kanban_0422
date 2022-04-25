<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsersMigration extends AbstractMigration
{
    public function up(): void
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', array('limit' => 64))
            ->addColumn('password', 'string')
            ->addColumn('status', 'integer')
            ->create();
    }

    public function down()
    {
//        $this->drop('users')->save();
    }
}
