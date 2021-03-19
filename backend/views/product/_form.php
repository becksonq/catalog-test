<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $productForm catalog\models\product\ProductForm */
/* @var $form yii\widgets\ActiveForm
 * @var $currencyList array
 * @var $promocodesList array
 */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($productForm, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($productForm, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($productForm, 'price')->textInput() ?>

    <?= $form->field($productForm, 'currency_id')->dropDownList($currencyList) ?>

<!--    --><?//= $form->field($productForm, 'promocode_id')->dropDownList($promocodesList, ['prompt' => 'Выберите скидку']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
