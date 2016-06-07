<?php

use yii\db\Migration;

class m160607_182332_goods_photos extends Migration
{
    public function up()
    {
        $this->createTable('goodsPhotos', [
            'id'    =>  $this->bigPrimaryKey(),
            'goodID'=>  $this->integer()->unsigned(),
            'order' =>  $this->integer(),
            'link'  =>  $this->string()
        ]);

        $this->createIndex('goodID', 'goodsPhotos', 'goodID');
        $this->createIndex('link', 'goodsPhotos', 'link');

    }

    public function down()
    {
        echo "m160607_182332_goods_photos cannot be reverted.\n";

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
