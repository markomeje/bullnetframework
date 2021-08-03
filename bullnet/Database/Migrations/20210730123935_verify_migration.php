<?php


declare(strict_types=1);
use Phinx\Migration\AbstractMigration;


final class VerifyMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('verify');
        $table->changeColumn('userid', 'integer', ['limit' => 12, 'null' => true])
            ->changeColumn('token', 'string', ['limit' => 255, 'null' => true])
            ->changeColumn('status', 'string', ['limit' => 40, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => CURRENT_TIMESTAMP])
            ->update();
    }
}
