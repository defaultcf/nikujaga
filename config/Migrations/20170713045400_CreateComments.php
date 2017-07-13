<?php
use Migrations\AbstractMigration;

class CreateComments extends AbstractMigration
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
        $table = $this->table('comments');
        $table->addColumn('comment', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('dish_id', 'integer')
              ->addForeignKey('dish_id', 'dishes', 'id', array('delete' => 'CASCADE'));
        $table->addColumn('user_id', 'integer')
              ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE'));
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
