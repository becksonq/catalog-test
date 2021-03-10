<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model catalog\models\product\Product
 * @var $currencyList array
 */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'        => $model,
        'currencyList' => $currencyList,
    ]) ?>

</div>
