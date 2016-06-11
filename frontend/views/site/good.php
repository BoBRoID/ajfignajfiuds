<?php
$this->title = 'Товар '.$good->name;

$this->params['breadcrumbs'][] = [
    'label' =>  $good->category->name,
    'url'   =>  '/category/'.$good->category->link
];

$this->params['breadcrumbs'][] = $this->title;

echo \frontend\widgets\LeftSidebarWidget::widget([
    'category'  =>  $good->category
]);
?>
<div class="col-md-9">

    <div class="row" id="productMain">
        <div class="col-sm-6">
            <div id="mainImage">
                <img src="/img/<?=$good->photo->link?>" alt="" class="img-responsive">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <h1 class="text-center"><?=$good->name?></h1>
                <p class="goToDescription"><a href="#details" class="scroll-to">Вниз, к описанию</a>
                </p>
                <p class="price">$<?=$good->price?></p>

                <p class="text-center buttons">
                    <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Купить</a>
                </p>


            </div>

            <div class="row" id="thumbs">
                <!--<div class="col-xs-4">
                    <a href="img/detailbig1.jpg" class="thumb">
                        <img src="img/detailsquare.jpg" alt="" class="img-responsive">
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="img/detailbig2.jpg" class="thumb">
                        <img src="img/detailsquare2.jpg" alt="" class="img-responsive">
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="img/detailbig3.jpg" class="thumb">
                        <img src="img/detailsquare3.jpg" alt="" class="img-responsive">
                    </a>
                </div>-->
            </div>
        </div>

    </div>


    <div class="box" id="details">
        <?=\kartik\grid\GridView::widget([
            'dataProvider'  =>  new \yii\data\ActiveDataProvider([
                'query'     =>  $good->getBalances()->with('store'),
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
                        return $model->store->name;
                    }
                ],
                [
                    'label' =>  'Колличество',
                    'value' =>  function($model){
                        return $model->count.' шт.';
                    }
                ]
            ]
        ]).
        \yii\helpers\Html::tag('h4', 'Описание товара').
        $good->description
        ?>

        <hr>
        <div class="social">
            <h4>Show it to your friends</h4>
            <p>
                <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
            </p>
        </div>
    </div>
</div>
