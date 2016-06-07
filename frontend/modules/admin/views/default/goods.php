<?php
$this->title = 'Товары';


echo \yii\helpers\Html::tag('h1', $this->title).
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