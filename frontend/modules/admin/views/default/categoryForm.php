<?php

switch(\Yii::$app->request->get("act")){
    case 'add':
        $mode = 'Добавление';
        break;
    case 'edit':
        $mode = 'Редактирование';
}

$this->title = $mode.' категории '.$category->name;

$form = \kartik\form\ActiveForm::begin();

echo \yii\helpers\Html::tag('div',
    \yii\helpers\Html::tag('div',
        $form->field($category, 'name').
        $form->field($category, 'parent').
        \yii\helpers\Html::tag('div',
            \yii\helpers\Html::button('Сохранить', ['class' => 'btn btn-success', 'type' => 'submit']),
            [
                'class' =>  'text-center'
            ]),
        [
            'class' =>  'well well-sm'
        ]),
    [
        'class' =>  'col-xs-8 col-xs-offset-2'
    ]);

$form->end();