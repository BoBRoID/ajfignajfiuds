<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

switch(\Yii::$app->request->get('act')){
    case 'add':
        $mode = 'Добавление категории';
        break;
    case 'edit':
        $this->params['breadcrumbs'][] = [
            'label' =>  'Категории',
            'url'   =>  '/admin/categories'
        ];

        $this->params['breadcrumbs'][] = [
            'label' =>  $category->name,
            'url'   =>  '/admin/category/'.$category->category->id
        ];

        $mode = 'Редактирование категории';
        break;
}

$possibleCategories = \common\models\Category::find()
    ->select(['id', 'name']);

if(\Yii::$app->request->get('act') == 'edit'){
    $possibleCategories->andWhere("`id` != '{$category->category->id}'");

    if(!empty($category->parent)){
        $possibleCategories->andWhere("`parent` != '{$category->category->id}'");
    }
}


$possibleCategories = $possibleCategories->orderBy('created ASC')->asArray()->all();

$this->title = $mode.' '.$category->name;

$this->params['breadcrumbs'][] = $mode;

$form = ActiveForm::begin([
    'type'  =>  ActiveForm::TYPE_HORIZONTAL
]);

echo Html::tag('div',
    Html::tag('div',
        Html::tag('div',
            Html::tag('h3', $this->title).
            $form->field($category, 'name').
            $form->field($category, 'parent')->dropDownList(array_merge([0 => 'отсутствует'], \yii\helpers\ArrayHelper::map($possibleCategories, 'id', 'name'))).
            Html::tag('div',
                Html::button('Сохранить', ['class' => 'btn btn-success', 'type' => 'submit']),
                [
                    'class' =>  'text-center'
                ]),
            [
                'class' =>  'box'
            ]),
        [
            'class' =>  'col-md-10 col-xs-offset-1'
        ]),
    [
        'class' =>  'col-xs-12'
    ]);

$form->end();