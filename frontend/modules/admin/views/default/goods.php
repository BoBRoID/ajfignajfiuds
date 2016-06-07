<?php
$this->title = 'Товары';


echo \yii\helpers\Html::tag('h1', $this->title).
    \yii\helpers\Html::a('+ добавить', '/admin/good?act=add', ['class' => 'btn btn-default']).
    \yii\helpers\Html::tag('br', '', ['style' => 'margin-bottom: 20px;']).
    \kartik\grid\GridView::widget([
        'dataProvider'  =>  $dataProvider,
        'summary'       =>  false,
        'options'       =>  [
            'class'     =>  'well'
        ],
        'columns'       =>  [
            'id',
            [
                'attribute' =>  'name',
                'format'    =>  'html',
                'value'     =>  function($model){
                    return \yii\helpers\Html::a($model->name, '/admin/good/'.$model->id);
                }
            ],
            [
                'label' =>  'Категория',
                'format'=>  'html',
                'value' =>  function($model){
                    if(empty($model->category)){
                        return '';
                    }

                    return \yii\helpers\Html::a($model->category->name, '/admin/category/'.$model->category->id);
                }
            ]
        ]
    ]);