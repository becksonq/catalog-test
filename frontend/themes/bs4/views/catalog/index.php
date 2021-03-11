<?php
/** @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $promocodeForm \catalog\models\product\PromocodeForm
 */
?>


<div class="promocode-form col-sm-6 mb-3">

    <?php $form = \yii\bootstrap4\ActiveForm::begin(); ?>

    <?= $form->field($promocodeForm, 'name')->textInput([
        'maxlength'   => true,
        'placeholder' => 'Введите промокод'
    ]) ?>

    <div class="form-group">
        <?= \yii\bootstrap4\Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php \yii\bootstrap4\ActiveForm::end(); ?>

</div>

<div class="col-sm-12 mb-5">
    <div class="row">
        <?php
        foreach ($dataProvider->getModels() as $model) {
            echo $this->render('_card', [
                'model' => $model,
            ]);
        }
        ?>
    </div>
</div>
