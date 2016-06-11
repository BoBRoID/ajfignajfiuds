<?php
use kartik\form\ActiveForm;

switch(\Yii::$app->request->get('act')){
    case 'add':
        $mode = 'Добавление товара';
        break;
    case 'edit':
        $this->params['breadcrumbs'][] = [
            'label' =>  'Товары',
            'url'   =>  '/admin/goods'
        ];

        $this->params['breadcrumbs'][] = [
            'label' =>  $good->name,
            'url'   =>  '/admin/good/'.$good->good->id
        ];

        $mode = 'Редактирование товара';
        break;
}


$this->params['breadcrumbs'][] = $mode;

$this->title = $mode.' "'.$good->name.'"';
?>
<div class="col-xs-12">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="box">
            <h3><?=$this->title?></h3>
        <?php
        $form = ActiveForm::begin([
            'type'  =>  ActiveForm::TYPE_HORIZONTAL
        ]);

        echo $form->field($good, 'name'),
            $form->field($good, 'description')
                ->textarea(),
            $form->field($good, 'price'),
            $form->field($good, 'category')
                ->dropDownList(
                    \yii\helpers\ArrayHelper::map(\common\models\Category::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name')
                ),
        \yii\helpers\Html::button('Сохранить', ['type' => 'submit', 'class' => 'btn btn-success center-block']);

        $form->end();
        ?>
        </div>
    </div>
</div>
