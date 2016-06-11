<?php
$this->title = 'Просмотр накладной №'.$invoice->id.'';


$this->params['breadcrumbs'][] = [
    'url'       =>  '/admin/invoices',
    'label'     =>  'Накладные'
];

$subTitle = 'Накладная №'.$invoice->id;

$this->params['breadcrumbs'][] = $subTitle;

?>

<div class="col-xs-12">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">
            <?=\yii\helpers\Html::tag('h3', $subTitle)?>
            <table class="table table-stripped" style="margin-top: 20px;">
                <tr>
                    <td>
                        Дата создания
                    </td>
                    <td>
                        <?=\Yii::$app->formatter->asDatetime($invoice->created)?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Откуда перемещали товары
                    </td>
                    <td>
                        <?=$invoice->sourceStoreModel->name?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Куда перемещали товары
                    </td>
                    <td>
                        <?=$invoice->targetStoreModel->name?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Кто перемещал товары
                    </td>
                    <td>
                        <?=\common\models\User::findOne($invoice->user)->username?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?=\kartik\grid\GridView::widget([
                            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                                'query' =>  $invoice->getItems()
                            ]),
                            'summary'   =>  false,
                            'condensed' =>  true,
                            'emptyText' =>  'Товары отсутствуют',
                            'bordered'  =>  false,
                            'beforeHeader'    =>  \yii\helpers\Html::tag('h4', 'Товары из накладной'),
                            'columns'   =>  [
                                [
                                    'class' =>  \kartik\grid\SerialColumn::className()
                                ],
                                [
                                    'attribute' =>  'goodID',
                                    'format'    =>  'html',
                                    'value'     =>  function($model){
                                        return \yii\bootstrap\Html::a($model->good->name, \yii\helpers\Url::to('/admin/good/'.$model->good->id));
                                    }
                                ],
                                [
                                    'attribute' =>  'count',
                                    'value'     =>  function($model){
                                        return $model->count.' шт.';
                                    }
                                ]
                            ]
                        ])?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
