<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model catalog\modules\promocode\models\Promocode */

$this->title = Yii::t('app', 'Update Promocode: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promocodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="promocode-update">

    <?= $this->render('_form', compact('promocodeForm', 'productList')) ?>

</div>
