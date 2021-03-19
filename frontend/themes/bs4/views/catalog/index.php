<?php

use yii\helpers\Url;

/** @var $this \yii\web\View
 * @var $products array
 * @var $promocodeForm \catalog\models\product\PromocodeForm
 */
?>


<div class="promocode-form col-sm-6 mb-3">

    <?php $form = \yii\bootstrap4\ActiveForm::begin([
        'action' => Url::to(['apply-promocode']),
    ]); ?>

    <?= $form->field($promocodeForm, 'name', [
        'inputTemplate' => '<div class="input-group mb-3">{input}<button class="btn btn-outline-secondary" type="submit" id="button-addon2">' . Yii::t('app',
                'Отправить') . '</button></div>',
    ])->textInput([
        'maxlength'   => true,
        'placeholder' => 'Введите промокод'
    ])->label(false) ?>
    <?php \yii\bootstrap4\ActiveForm::end(); ?>

</div>

<div class="col-sm-12 mb-5">
    <div class="row">
        <?php
        foreach ($products as $product) {
            echo $this->render('_card', [
                'product' => $product,
            ]);
        } ?>
    </div>
</div>
