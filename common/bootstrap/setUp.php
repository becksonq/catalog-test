<?php


namespace common\bootstrap;


use catalog\modules\promocode\models\store\SessionStoreDiscount;
use catalog\modules\promocode\models\store\StoreInterface;
use yii\base\Application;

class setUp implements \yii\base\BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(StoreInterface::class, SessionStoreDiscount::class);
    }
}