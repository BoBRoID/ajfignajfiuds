<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-6">
    <div class="box">
        <h1>Новый клиент</h1>

        <p class="lead">Впервые у нас?</p>
        <p>С регистрацией вы получите доступ к личному кабинету. Регистрация занимает меньше минуты!</p>
        <p class="text-muted">Вы можете связаться с нами в любое время через <?=Html::a('страницу контактов', \yii\helpers\Url::to(['site/contact']))?></p>

        <hr>

        <?php
        $form = ActiveForm::begin();

        echo $form->field($signupForm, 'username'),
            $form->field($signupForm, 'email'),
            $form->field($signupForm, 'password')->passwordInput(),
            Html::tag('div', Html::button(Html::tag('i', '', ['class' => 'fa fa-user']).' Регистрация', ['type' => 'submit', 'class' => 'btn btn-primary']), ['class' => 'text-center']);

        $form->end();
        ?>

    </div>
</div>

<div class="col-md-6">
    <div class="box">
        <h1>Войти</h1>

        <p class="lead">Уже зарегистрированы?</p>
        <p class="text-muted">Введите свои данные для входа в форму ниже для авторизации</p>

        <hr>

        <?php
        $form = ActiveForm::begin([
            'action'    =>  \yii\helpers\Url::to(['site/login'])
        ]);

        echo $form->field($loginForm, 'email'),
            $form->field($loginForm, 'password')->passwordInput(),
            Html::tag('div', Html::button(
                Html::tag('i', '', ['class' => 'fa fa-sign-in']).' Войти', [
                    'class' => 'btn btn-primary',
                    'type'  =>  'submit'
                ]
            ), [
                'class' => 'text-center'
            ]);

        $form->end();

        ?>
    </div>
</div>
