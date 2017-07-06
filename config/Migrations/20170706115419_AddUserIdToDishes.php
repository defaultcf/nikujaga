<?php
use Migrations\AbstractMigration;

class AddUserIdToDishes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('dishes');
        $table->addColumn('user_id', 'integer')
              ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE'));
        $table->update();
    }
}
