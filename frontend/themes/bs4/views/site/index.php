<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="col-sm-12">
                <?= Html::a('Перейти в каталог', Url::to(['/catalog/index']), []) ?>
            </div>
        </div>
    </div>
</div>
