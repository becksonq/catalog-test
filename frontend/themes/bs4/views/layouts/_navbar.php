<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

?>
<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl'   => Yii::$app->homeUrl,
    'options'    => [
        'class' => 'navbar navbar-expand-lg navbar-light bg-warning',
//        'style' => "background-color: #e3f2fd;"
    ],
]);

echo Nav::widget([
    'items'   => [
        [
            'label' => 'Home',
            'url'   => Url::to('/site/index'),
        ],
        [
            'label'   => Yii::t('app', 'Catalog'),
            'url'     => Url::to(['/catalog/index']),
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label'   => 'Signup',
            'url'     => Url::to(['/site/signup']),
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label'   => 'Login',
            'url'     => Url::to(['/site/login']),
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label'       => Yii::t('app', 'Выйти'),
            'url'         => Url::to(['/site/logout']),
            'visible'     => !Yii::$app->user->isGuest,
            'linkOptions' => [
                'data-method' => 'post',
            ],
        ],
    ],
    'options' => ['class' => 'navbar-nav ml-5 '],
]);
NavBar::end();

?>