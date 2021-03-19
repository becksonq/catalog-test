<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use catalog\modules\promocode\models\PromocodeService;

/* @var $this yii\web\View */
/* @var $promocodeForm catalog\modules\promocode\models\PromocodeForm */
/* @var $form yii\widgets\ActiveForm
 * @var $productList array
 */
?>

<div class="promocode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($promocodeForm, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($promocodeForm, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($promocodeForm, 'type')->dropDownList(PromocodeService::discountList(), ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($promocodeForm, 'products')->dropDownList($productList, ['multiple'=>'multiple']) ?>

    <?= $form->field($promocodeForm, 'start')->textInput() ?>

    <?= $form->field($promocodeForm, 'end')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
