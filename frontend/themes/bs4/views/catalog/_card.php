<?php

use yii\bootstrap4\Html;
use catalog\models\product\ProductService;
use yii\helpers\Url;

/** @var $model \catalog\models\product\Product */
?>

<div class="col-sm-12 mb-3">
    <div class="card">
        <div class="card-body">
            <?= Html::tag('h5', $model->name, ['class' => 'card-title']) ?>

            <p class="card-text">Цена: <?= sprintf("%.2f", $model->price) ?>
                <?php if ($model->old_price !== null) : ?>
                    <del><?= sprintf("%.2f", $model->old_price) ?></del>
                <?php endif; ?>
            </p>

            <?php
            if ($model->currency->type !== \catalog\models\currency\Currency::ORIGIN_PRICE) : ?>
                <p class="card-text">Цена в рублях: <?= sprintf("%.2f", ($model->price * $model->currency->rate)) ?> руб.</p>
            <?php endif; ?>
            <p class="card-text">
                <?= ProductService::isPromocode($model) ?>
                <?= Html::a('<i class="bi bi-trash"></i>', Url::to(['remove-discount', 'id' => $model->id]), ['class' => 'btn btn-light btn-sm', 'title' => 'Отменить промокод']) ?>
            </p>
            <?= Html::a('Перейти', null, [
                'class' => 'btn btn-primary',
                'href'  => 'javascript:void(0);',
            ]) ?>
        </div>
    </div>
</div>
