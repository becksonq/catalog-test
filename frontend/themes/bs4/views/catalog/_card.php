<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

/** @var $product \catalog\models\product\ProductDto */
?>

<div class="col-sm-12 mb-3">
    <div class="card">
        <div class="card-body">
            <?= Html::tag('h5', $product->name, ['class' => 'card-title']) ?>
            <p class="card-text">Цена: <?= $product->price ?>
                <?= $product->old_price ?>
            </p>
            <?= $product->rublePrice ?>
            <p class="card-text">
                <?= $product->promocode ?>
                <?= Html::a('<i class="bi bi-trash"></i>', Url::to(['remove-discount', 'id' => $product->id]),
                    ['class' => 'btn btn-light btn-sm', 'title' => 'Отменить промокод']) ?>
            </p>
            <?= Html::a('Перейти', null, [
                'class' => 'btn btn-primary',
                'href'  => 'javascript:void(0);',
            ]) ?>
        </div>
    </div>
</div>
