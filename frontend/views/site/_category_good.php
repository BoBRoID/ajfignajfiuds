<?php
/** @var \frontend\models\Good $model */
?>
<div class="col-md-4 col-sm-6">
    <div class="product">
        <div class="flip-container">
            <div class="flipper">
                <div class="front">
                    <a href="/good/<?=$model->getLink()?>">
                        <img src="/img/<?=$model->photo->link?>" alt="" class="img-responsive">
                    </a>
                </div>
                <?php if(!empty($model->secondPhoto)){ ?>
                <div class="back">
                    <a href="/good/<?=$model->getLink()?>">
                        <img src="/img/<?=$model->secondPhoto->link?>" alt="" class="img-responsive">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <a href="/good/<?=$model->getLink()?>" class="invisible">
            <img src="/img/<?=$model->photo->link?>" alt="" class="img-responsive">
        </a>
        <div class="text">
            <h3><a href="/good/<?=$model->getLink()?>"><?=$model->name?></a></h3>
            <p class="price">$<?=$model->price?></p>
            <p class="buttons">
                <a href="/good/<?=$model->getLink()?>" class="btn btn-default">Подробнее</a>
                <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Купить</a>
            </p>
        </div>
    </div>
</div>