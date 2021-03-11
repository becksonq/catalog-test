<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use catalog\modules\promocode\models\PromocodeService;

/* @var $this yii\web\View */
/* @var $model catalog\modules\promocode\models\Promocode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(PromocodeService::discountList(), ['prompt' => 'Выберите тип']) ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
