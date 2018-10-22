<?php


use Phinx\Migration\AbstractMigration;

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
    public function change()
    {
        $sql = 'CREATE TABLE media (
          id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
          relpath VARCHAR(255) NOT NULL,
          filepath VARCHAR(255) NOT NULL,
          opDisplay VARCHAR(20) DEFAULT "image" NULL,
          displayOg TINYINT(1) DEFAULT 0 NULL,
          savefile BLOB,
          docID INT,
          postId INT,
          createdOn DATETIME,
           modifiedOn TIMESTAMP DEFAULT NOW()
        );';

        $this->execute($sql);

    }
}
