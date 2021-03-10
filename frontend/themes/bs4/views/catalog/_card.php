<?php

use yii\bootstrap4\Html;

/** @var $model \catalog\models\product\Product */
?>

<div class="col-sm-12 mb-3">
    <div class="card">
        <div class="card-body">
            <?= Html::tag('h5', $model->name, ['class' => 'card-title']) ?>
            <p class="card-text">Цена: <?= $model->price ?></p>
            <?php
            if ($model->currency->type !== \catalog\models\currency\Currency::ORIGIN_PRICE) : ?>
                <p class="card-text">Цена в рублях: <?= $model->price * $model->currency->rate ?></p>
            <?php endif; ?>
            <?= Html::a('Смотреть', null, [
                'class' => 'btn btn-primary',
                'href'  => 'javascript:void(0);',
            ]) ?>
        </div>
    </div>
</div>
