<?php
/**
 * Created by PhpStorm.
 * User: bobroid
 * Date: 07.06.16
 * Time: 23:42
 */

/** @var \common\models\Good $good */
$this->title = 'Товар "'.$good->name.'"';

$this->params['breadcrumbs'][] = [
    'url'       =>  '/admin/goods',
    'label'     =>  'Товары'
];

$this->params['breadcrumbs'][] = $good->name;

$this->registerJsFile('/js/sweetalert.min.js', ['depends' => 'yii\web\JqueryAsset']);
$this->registerCssFile('/css/sweetalert.css');

$js = <<<'JS'
$("body").on('click', '.transferItem', function(e){
    var button = $(this);

    swal({
      title: "Переместить товары",
      text: "Сколько товаров вы хотите переместить?",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Write something"
    },
    function(inputValue){
      if (inputValue === false) return false;
      
      if (inputValue === "") {
        swal.showInputError("Необходимо заполнить это поле!");
        return false
      }else if(inputValue > parseInt(button.parent().parent().find("button.kv-editable-value").html().replace(/\D+/, ''))){
        swal.showInputError("Нельзя переместить больше чем есть!");
        return false;
      }
      
      swal({
          title: "Переместить товары",
          text: "Введите ID склада",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: "Write something"
        },
        function(store){
          if (store === false) return false;
          
          if (store === "") {
            swal.showInputError("Необходимо заполнить это поле!");
            return false
          }
          
          $.ajax({
            type: 'POST',
            url: '/admin/transfer-items',
            data: {
                'sourceStore': button.attr('data-storeid'),
                'targetStore': store,
                'itemsCount': inputValue,
                'itemID': $("#goodID").attr('data-itemID')
            },
            success: function(data){
                swal("Успех!", "Вы переместили " + inputValue + " товаров на склад " + store, "success");
                location.reload();
            },
            error: function(data){
                swal("Неудача!", "Не удалось переместить товары со склада. Причина: " + data.responseText, "error");
            }
        });
          
        });
    });
});
JS;

$this->registerJs($js);

?>
<div class="col-xs-12">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">
            <?=\yii\helpers\Html::tag('h3', $this->title, ['data-itemID' => $good->id, 'id' => 'goodID'])?>
            <?=\yii\helpers\Html::a('редактировать', '/admin/good/'.$good->id.'?act=edit', ['class' => 'btn btn-default'])?>
            <table class="table table-stripped" style="margin-top: 20px;">
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
                                    'width'     =>  '40px',
                                    'editableOptions'   =>  function($model, $key, $index) use ($good){
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
                                ],[
                                    'class'     =>  \kartik\grid\ActionColumn::className(),
                                    'width'     =>  '40px',
                                    'buttons'   =>  [
                                        'move'  =>  function($key, $model) use ($good){
                                            if(empty($good->getBalance($model->id)->count)){
                                                return '';
                                            }

                                            return \yii\bootstrap\Html::button('<i class="fa fa-truck"></i> переместить', ['data-storeID' => $model->id, 'class' => 'transferItem btn btn-link btn-sm']);
                                        }
                                    ],
                                    'template'  =>  '{move}'
                                ]
                            ]
                        ])?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
