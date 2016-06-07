<?php
$this->title = 'Категория '.$category->name;

$this->params['breadcrumbs'][] = $this->title;

echo \frontend\widgets\LeftSidebarWidget::widget([
    'category'  =>  $category
]);
?>
<div class="col-md-9">
    <div class="box">
        <h1><?=$category->name?></h1>
        <?=!empty($category->description) ? \yii\helpers\Html::tag('p', $category->description) : ''?>
    </div>
    <?=\yii\widgets\ListView::widget([
        'dataProvider'  =>  $categoryGoods,
        'summary'       =>  '<div class="box info-bar">
            <div class="row">
                <div class="col-sm-12 col-md-4 products-showing">
                    Показаны товары <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>
                </div>
            </div>
        </div>',
        'layout'    =>  '{summary}<div class="products row">{items}</div><div class="pages">{pager}</div>',
        'itemView'      =>  '_category_good'
    ])?>
</div>