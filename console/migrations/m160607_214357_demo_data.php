<?php

use yii\db\Migration;

class m160607_214357_demo_data extends Migration
{
    public function up()
    {
        $category = new \common\models\Category([
            'name'  =>  'Ноутбуки'
        ]);

        $category->save(false);

        $sub = new \common\models\Category([
            'name'  =>  'Игровые',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Игровой ноутбук 1', '200'], ['Игровой ноутбук 2', '210'], ['Игровой ноутбук 3', '225'], ['Игровой ноутбук 4', '235']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        $sub = new \common\models\Category([
            'name'  =>  'Офисные',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Офисный ноутбук 1', '100'], ['Офисный ноутбук 2', '110'], ['Офисный ноутбук 3', '125'], ['Офисный ноутбук 4', '135']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        $sub = new \common\models\Category([
            'name'  =>  'Дешёвые',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Дешёвый ноутбук 1', '50'], ['Дешёвый ноутбук 2', '60'], ['Дешёвый ноутбук 3', '75'], ['Дешёвый ноутбук 4', '80']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        $category = new \common\models\Category([
            'name'  =>  'Телефоны'
        ]);

        $category->save(false);

        $sub = new \common\models\Category([
            'name'  =>  'Смартфоны',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Смартфон 1', '150'], ['Смартфон 2', '160'], ['Смартфон 3', '175'], ['Смартфон 4', '180']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        $sub = new \common\models\Category([
            'name'  =>  'Раскладушки',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Раскладушка 1', '150'], ['Раскладушка 2', '160'], ['Раскладушка 3', '175'], ['Раскладушка 4', '180']] as $good) {
            $goodM = new \common\models\Good([
                'name' => $good[0],
                'price' => $good[1],
                'categoryID' => $sub->id
            ]);

            $goodM->save(false);
        }

        $sub = new \common\models\Category([
            'name'  =>  'Имиджевые',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['Имиджевый 1', '150'], ['Имиджевый 2', '160'], ['Имиджевый 3', '175'], ['Имиджевый 4', '180']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        $sub = new \common\models\Category([
            'name'  =>  'iPhone',
            'parent'=>  $category->id
        ]);

        $sub->save(false);

        foreach([['iPhone 1', '400'], ['iPhone 2', '500'], ['iPhone 3', '600'], ['iPhone 4', '700']] as $good){
            $goodM = new \common\models\Good([
                'name'  =>  $good[0],
                'price' =>  $good[1],
                'categoryID'  =>  $sub->id
            ]);

            $goodM->save(false);
        }

        foreach(['Склад Киев', 'Склад Харьков', 'Склад Маями', 'Склад Будапешт', 'Склад Воображеляндия'] as $storeName){
            $store = new \common\models\Store([
                'name'  =>  $storeName
            ]);

            $store->save(false);
        }
    }

    public function down()
    {
        echo "m160607_214357_demo_data cannot be reverted.\n";

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
