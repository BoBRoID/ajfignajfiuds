<?php

use yii\db\Migration;

class m160607_194039_stores extends Migration
{
    public function up()
    {
        $this->createTable('stores', [
            'id'        =>  $this->bigPrimaryKey(),
            'name'      =>  $this->string(),
        ]);
    }

    public function down()
    {
        echo "m160607_194039_stores cannot be reverted.\n";

        return true;
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
