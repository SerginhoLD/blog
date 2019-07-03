<?php 

use Phalcon\Db\AdapterInterface;
use Phalcon\Mvc\Model\Migration;

/**
 * Class InitMigration_100
 * @method AdapterInterface getConnection()
 */
class InitMigration_100 extends Migration
{
    public function up()
    {
        $this->getConnection()->execute(file_get_contents(__DIR__ . '/init.sql'));
    }

    public function down()
    {
    }
}
