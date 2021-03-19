<?php


namespace common\bootstrap;


use yii\base\Application;

class setUp implements \yii\base\BootstrapInterface
{

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $container = \Yii::$container;
    }
}