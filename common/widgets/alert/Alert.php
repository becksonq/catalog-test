<?php


namespace common\widgets\alert;


use yii\base\Widget;

/**
 * Class Alert
 * @package frontend\themes\createx\widgets
 *
 * Usage:
 * --------------------------------------
 * <?= Alert::widget([]) ?>
 */
class Alert extends Widget
{
    public function run()
    {
        return $this->render('index');
    }
}