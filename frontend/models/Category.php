<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 07.06.16
 * Time: 23:24
 */

namespace frontend\models;


class Category extends \common\models\Category
{
    
    public function getGoods(){
        return $this->hasMany(Good::className(), ['categoryID' => 'id']);
    }

    public function getSubcategoriesGoods(){
        $categories = [$this->id];

        if(!empty($this->childs)){
            foreach($this->childs as $child){
                $categories[] = $child->id;
            }

        }


        return Good::find()->andWhere(['in', 'categoryID', $categories]);
    }

}