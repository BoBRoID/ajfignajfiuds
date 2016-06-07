<?php

switch(\Yii::$app->request->get("act")){
    case 'add':
        $mode = 'Добавление';
        break;
    case 'edit':
        $mode = 'Редактирование';
}

$this->title = $mode.' товара '.$good->name;
?>
<h1><?=$mode?> товара</h1>
<div class="col-xs-12">
    <div class="col-xs-8 col-xs-offset-2">
        <div class="well">
        <?php
        use kartik\form\ActiveForm;

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
