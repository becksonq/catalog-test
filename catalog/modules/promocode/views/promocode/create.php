<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model catalog\modules\promocode\models\Promocode */

$this->title = Yii::t('app', 'Create Promocode');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promocodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocode-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
