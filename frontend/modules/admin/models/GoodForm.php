<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 07.06.16
 * Time: 23:57
 */

namespace frontend\modules\admin\models;


use common\models\Good;
use yii\base\Model;

class GoodForm extends Model
{

    public $name;

    public $description;

    public $category;

    public $price;

    private $good;

    public function attributeLabels()
    {
        $good = new Good();

        return $good->attributeLabels();
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'string'],
            [['category', 'price'], 'number'],
            [['name', 'category', 'price'], 'required']
        ];
    }

    public function loadGood($good){
        $this->setAttributes([
            'name'          =>  $good->name,
            'description'   =>  $good->description,
            'category'      =>  $good->category,
            'price'         =>  $good->price
        ]);

        $this->good = $good;
    }

    public function getGood(){
        return $this->good;
    }

    public function save(){
        if(empty($this->good)){
            $this->good = new Good();
        }

        $this->good->setAttributes([
            'name'          =>  $this->name,
            'description'   =>  $this->description,
            'category'      =>  $this->category,
            'price'         =>  $this->price
        ]);

        return $this->good->save(false);
    }

}