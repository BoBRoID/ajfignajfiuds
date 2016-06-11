<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 10.06.16
 * Time: 11:08
 */

namespace frontend\modules\admin\models;


use frontend\models\Category;
use yii\base\Model;

class CategoryForm extends Model
{

    public $name;

    public $parent;

    private $category;

    public function getCategory(){
        return $this->category;
    }

    public function rules(){
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['parent'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  =>  'Название',
            'parent'=>  'Категория-родитель'
        ];
    }

    public function loadCategory($category){
        $this->category = $category;

        $this->setAttributes([
            'name'  =>  $category->name,
            'parent'=>  $category->parent
        ]);
    }

    public function save(){
        if(empty($this->category)){
            $this->category = new Category();
        }

        $this->category->setAttributes([
            'name'  =>  $this->name,
            'parent'=>  $this->parent
        ]);

        return $this->category->save(false);
    }

}