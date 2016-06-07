<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 07.06.16
 * Time: 23:42
 */

/** @var \common\models\Good $good */
$this->title = 'Просмотр товара "'.$good->name.'"';

echo \yii\helpers\Html::tag('h1', $this->title.\yii\helpers\Html::tag('small', \yii\helpers\Html::a('редактировать', '/admin/good/'.$good->id.'?act=edit')));
?>
<div class="col-xs-12">
    <div class="col-xs-8 col-xs-offset-2">
        <div class="well">
            <table class="table table-stripped">
                <tr>
                    <td>
                        Название
                    </td>
                    <td>
                        <?=$good->name?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Описание
                    </td>
                    <td>
                        <?=$good->description?>
                    </td>
                </tr>
                <?php if(!empty($good->categoryID)){ ?>
                    <tr>
                        <td>
                            Категория
                        </td>
                        <td>
                            <?=\yii\helpers\Html::a($good->category->name, '/admin/category/'.$good->category->id)?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td>
                        Цена
                    </td>
                    <td>
                        <?=$good->price?>$
                    </td>
                </tr>
                <tr>
                    <td>
                        Создано
                    </td>
                    <td>
                        <?=\Yii::$app->formatter->asDate($good->created)?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Обновлено
                    </td>
                    <td>
                        <?=\Yii::$app->formatter->asDate($good->updated)?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?=\kartik\grid\GridView::widget([
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
                                ],
                                [
                                    'label' =>  'Колличество',
                                    'value' =>  function($model) use(&$good){
                                        return $good->getBalance($model->id)->count.' шт.';
                                    },
                                    'class' =>  \kartik\grid\EditableColumn::className(),
                                    'editableOptions'   =>  function($model, $key, $index) use (&$good){
                                        return [
                                            'name'          =>  'storeCount',
                                            'value'         =>  empty($good->getBalance($model->id)->count) ? 0 : $good->getBalance($model->id)->count,
                                            'ajaxSettings'  =>  [
                                                'url'   =>  \yii\helpers\Url::to(['/admin/balance-change?goodID='.$good->id])
                                            ],
                                            'displayValue'  =>  (empty($good->getBalance($model->id)->count) ? 0 : $good->getBalance($model->id)->count).' шт.',
                                            'valueIfNull'   =>  '(нет)',
                                            'header'    =>  ' остатка на складе',
                                            'size'      =>  'sm',
                                            'preHeader' =>  'Изменение',
                                            'submitButton'   =>  [
                                                'label' =>  'Сохранить',
                                                'class' =>  'btn btn-success btn-sm'
                                            ],
                                            'resetButton'   =>  [
                                                'label' =>  'Очистить',
                                                'class' =>  'btn btn-info btn-sm'
                                            ],
                                        ];
                                    },
                                ]
                            ]
                        ])?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
