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
        'class' => 'navbar navbar-expand-lg navbar-light',
        'style' => 'background-color: #42d697;',
    ],
]);

echo Nav::widget([
    'items'   => [
        [
            'label' => 'Home',
            'url'   => Url::to('/site/index'),
        ],
        [
            'label' => 'Apples',
            'url'   => Url::to(['/apples/apples/index'])
        ],
        [
            'label'   => Yii::t('app', 'Вход'),
            'url'     => Url::to(['/user/registration/register']),
            'visible' => Yii::$app->user->isGuest,
        ],
        [
            'label'       => Yii::t('app', 'Выйти'),
            'url'         => Url::to(['/user/security/logout']),
            'visible'     => !Yii::$app->user->isGuest,
            'linkOptions' => [
                'data-method' => 'post',
            ],
        ],
    ],
    'options' => ['class' => 'navbar-nav ml-5'],
]);
NavBar::end();

?>