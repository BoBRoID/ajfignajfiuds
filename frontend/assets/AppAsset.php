<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100',
        'css/font-awesome.css',
        'css/animate.min.css',
        'css/owl.carousel.css',
        'css/owl.theme.css',
        'css/style.default.css',
        'css/custom.css'
    ];
    public $js = [
        'js/respond.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
