<?php

use yii\db\Migration;

class m160611_140428_users_access_level extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'accessLevel', $this->smallInteger()->unsigned()->defaultValue(0));
    }

    public function down()
    {
        echo "m160611_140428_users_access_level cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
