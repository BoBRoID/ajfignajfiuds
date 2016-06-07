<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 07.06.16
 * Time: 22:38
 */

namespace frontend\widgets;


use frontend\models\Category;
use yii\base\Widget;
use yii\helpers\Html;

class LeftSidebarWidget extends Widget
{

    public $category = null;

    public function run(){
        return '<div class="col-md-3">
    <div class="panel panel-default sidebar-menu">

        <div class="panel-heading">
            <h3 class="panel-title">Категории</h3>
        </div>

        <div class="panel-body">
            <ul class="nav nav-pills nav-stacked category-menu">
            '.$this->renderItems().'
            </ul>

        </div>
    </div>
</div>';
    }

    public function renderItems(){
        $items = [];
        foreach (Category::find()->where(['parent' => 0])->with('childs')->with('goods')->each() as $category){
            $items[] = $this->renderItem($category);
        }

        return implode('', $items);
    }

    public function renderItem($category, $subcategory = false){
        $text = '';
        $categoryName = $category->name;
        $hasChilds = !empty($category->childs);

        if(!$subcategory){
            $categoryName .= Html::tag('span', count($category->goods), ['class' => 'badge pull-right']);
        }

        $text .= Html::a($categoryName, '/category/'.$category->link);

        if(!$subcategory && $hasChilds){
            $subtext = '';

            foreach($category->childs as $childCategory){
                $subtext .= $this->renderItem($childCategory, true);
            }

            $text .= Html::tag('ul', $subtext);
        }

        if(empty($this->category)){
            $this->category = new Category();
        }

        $currentCategory = $this->category;

        return Html::tag('li', $text, ['class' => ($currentCategory->id == $category->id && !$currentCategory->isNewRecord) ? 'active' : '']);
    }

}