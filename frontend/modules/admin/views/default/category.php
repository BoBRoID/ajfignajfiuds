<?php

$this->title = 'Просмотр категории "'.$category->name.'"';


$this->params['breadcrumbs'][] = [
    'url'       =>  '/admin/categories',
    'label'     =>  'Категории'
];

$this->params['breadcrumbs'][] = $category->name;
?>

<div class="col-xs-12">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">
            <?=\yii\helpers\Html::tag('h3', $this->title)?>
            <?=\yii\helpers\Html::a('редактировать', '/admin/category/'.$category->id.'?act=edit', ['class' => 'btn btn-default'])?>
            <table class="table table-stripped" style="margin-top: 20px;">
                <tr>
                    <td>
                        Название
                    </td>
                    <td>
                        <?=$category->name?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ссылка (алиас)
                    </td>
                    <td>
                        <?=$category->link?>
                    </td>
                </tr>
                <?php if(!empty($category->parent)){ ?>
                    <tr>
                        <td>
                            Родительская категория
                        </td>
                        <td>
                            <?=\yii\helpers\Html::a($category->parentCategory->name, '/admin/category/'.$category->parentCategory->id)?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>
                        Создано
                    </td>
                    <td>
                        <?=\Yii::$app->formatter->asDate($category->created)?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Обновлено
                    </td>
                    <td>
                        <?=\Yii::$app->formatter->asDate($category->updated)?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?=''/*\kartik\grid\GridView::widget([
                            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                                'query'     =>  \common\models\Store::find(),
                            ]),
                            'summary'   =>  false,
                            'condensed' =>  true,
                            'emptyText' =>  'Товар на складах отсутствует',
                            'bordered'  =>  false,
                            'beforeHeader'    =>  \yii\helpers\Html::tag('h4', 'Остатки на складах'),
                            'columns'   =>  [
                                [
                                    'class' =>  \kartik\grid\SerialColumn::className()
                                ],
                                [
                                    'label' =>  'Название склада',
                                    'value' =>  function($model){
                                        return $model->name;
                                    }
                                ]
                            ]
                        ])*/?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

