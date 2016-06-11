<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'language'  =>  'ru',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'       =>  [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'admin' => [
            'class' => 'frontend\modules\admin\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class'         =>  'yii\rbac\PhpManager',
            'defaultRoles'  =>  ['user', 'admin']
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ''                  =>  'site/index',
                'admin'             =>  'admin/default/index',
                'admin/<action>'    =>  'admin/default/<action>',
                'admin/<action:(category|good)>/<id>'    =>  'admin/default/<action>',
                '<action>'          =>  'site/<action>',
                'category/<link:(.*)>'   =>  'site/category',
                'good/<link>'       =>  'site/good',
                '<action>/<param>'  =>  'site/<action>',
            ],
        ],
    ],
    'params' => $params,
];
