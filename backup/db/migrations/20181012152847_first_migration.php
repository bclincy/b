<?php


use Phinx\Migration\AbstractMigration;
use \Phinx\Util\Literal;

class FirstMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     * vendor/bin/phinx migrate -e development
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {

        $exists = $this->hasTable('media');
        if ($exists === false) {
            $table = $this->tables('media');
            $table->addColumn('relpath', 'string', ['null' => false])
              ->addColumn('filepath', 'string', ['null'=> false])
              ->addColumn('opDisplay', 'string', ['limit' => 20, 'default' => 'image'])
              ->addColumn('displayOg', 'smallinteger', ['default' => 0])
              ->addColumn('savefile', 'blob')
              ->addColumn('docID')
              ->addColumn('createdOn', 'timestamp', ['default' => Literal::from('now()')])
              ->addColumn('modifiedOn', 'timestamp', ['default' => Literal::from('now()')])
              ->save();
        }

    }

    public function down()
    {
        $this->table('media')->drop()->save();
    }
}
