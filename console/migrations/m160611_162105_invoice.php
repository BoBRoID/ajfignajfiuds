<?php

use yii\db\Migration;

class m160611_162105_invoice extends Migration
{
    public function up()
    {
        $this->createTable('invoice', [
            'id'            =>  $this->bigPrimaryKey(),
            'sourceStore'   =>  $this->integer()->unsigned()->notNull(),
            'targetStore'   =>  $this->integer()->unsigned()->notNull(),
            'created'       =>  $this->dateTime(),
            'user'          =>  $this->integer()->unsigned()->notNull()
        ]);

        $this->createTable('invoiceItems', [
            'invoiceID' =>  $this->integer()->unsigned()->notNull(),
            'goodID'    =>  $this->integer()->unsigned()->notNull(),
            'count'     =>  $this->integer()->unsigned()->notNull()
        ]);
    }

    public function down()
    {
        echo "m160611_162105_invoice cannot be reverted.\n";

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
