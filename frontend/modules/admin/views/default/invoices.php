<?php
use kartik\grid\GridView;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Накладные';

$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="col-md-3">
        <!-- *** CUSTOMER MENU ***
    _________________________________________________________ -->
        <div class="panel panel-default sidebar-menu">

            <div class="panel-heading">
                <h3 class="panel-title">Кабинет пользователя</h3>
            </div>

            <div class="panel-body">

                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="/cabinet"><i class="fa fa-user"></i> Мой аккаунт</a>
                    </li>
                    <?php if(\Yii::$app->user->identity->accessLevel == 1){ ?>
                        <li>
                            <a href="/admin/goods"><i class="fa fa-list"></i> Товары</a>
                        </li>
                        <li>
                            <a href="/admin/categories"><i class="fa fa-list"></i> Категории</a>
                        </li>
                        <li class="active">
                            <a href="/admin/invoices"><i class="fa fa-file"></i> Накладные</a>
                        </li>
                    <?php }
                    echo Html::tag('li', Html::a('<i class="fa fa-sign-out"></i> Выйти',
                        Url::to('/logout'), [
                            'data-method'   =>  'post'
                        ]));
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.col-md-3 -->

        <!-- *** CUSTOMER MENU END *** -->
    </div>

<?=Html::tag('div', GridView::widget([
    'dataProvider'  =>  $dataProvider,
    'summary'       =>  false,
    'pjax'          =>  true,
    'options'       =>  [
        'class'     =>  'box'
    ],
    'layout'    =>
        Html::tag('h1', $this->title).
        Html::a('+ добавить', '/admin/good?act=add', ['class' => 'btn btn-default']).'<br><br>{items}<div class="text-center">{pager}</div>',
    'columns'       =>  [
        [
            'attribute' =>  'id',
            'format'    =>  'html',
            'value'     =>  function($model){
                return Html::a($model->id, Url::to('/admin/invoice/'.$model->id));
            }
        ],
        [
            'attribute' =>  'created',
            'format'    =>  'html',
            'value'     =>  function($model){
                return \Yii::$app->formatter->asDatetime($model->created);
            }
        ],
        [
            'label' =>  'Из магазина',
            'format'=>  'html',
            'value' =>  function($model){
                return $model->sourceStoreModel->name;
            }
        ],
        [
            'label' =>  'В магазин',
            'format'=>  'html',
            'value' =>  function($model){
                return $model->targetStoreModel->name;
            }
        ]
    ]
]), [
    'class' =>  'col-md-9'
])?>