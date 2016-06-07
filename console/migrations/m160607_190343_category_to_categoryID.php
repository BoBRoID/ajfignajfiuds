<?php

use yii\db\Migration;

class m160607_190343_category_to_categoryID extends Migration
{
    public function up()
    {
        $this->renameColumn('goods', 'category', 'categoryID');
    }

    public function down()
    {
        echo "m160607_190343_category_to_categoryID cannot be reverted.\n";

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
