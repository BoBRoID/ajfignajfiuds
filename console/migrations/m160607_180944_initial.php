<?php

use yii\db\Migration;

class m160607_180944_initial extends Migration
{
    public function up()
    {
        $this->createTable('goods', [
            'id'            =>  $this->bigPrimaryKey(),
            'name'          =>  $this->string(),
            'link'          =>  $this->string(),
            'description'   =>  $this->text(),
            'price'         =>  $this->float()->notNull()->defaultValue(0),
            'category'      =>  $this->integer()->notNull()->defaultValue(0),
            'created'       =>  $this->dateTime(),
            'updated'       =>  $this->dateTime()
        ]);

        $this->createIndex('name', 'goods', 'name');
        $this->createIndex('category', 'goods', 'category');
        $this->createIndex('link', 'goods', 'link');

        $this->createTable('goodsStore', [
            'goodID'    =>  $this->integer(),
            'storeID'   =>  $this->integer(),
            'count'     =>  $this->integer()
        ]);

        $this->addPrimaryKey('good', 'goodsStore', ['goodID', 'storeID']);

        $this->createTable('categories', [
            'id'            =>  $this->bigPrimaryKey(),
            'name'          =>  $this->string(),
            'parent'        =>  $this->integer(),
            'link'          =>  $this->string(),
            'created'       =>  $this->dateTime(),
            'updated'       =>  $this->dateTime(),
        ]);

        $this->createIndex('name', 'categories', 'name');
        $this->createIndex('link', 'categories', 'link');
    }

    public function down()
    {
        echo "m160607_180944_initial cannot be reverted.\n";

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
