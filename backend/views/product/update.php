<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model catalog\models\product\Product
 * @var $currencyList array
 * @var $promocodesList array
 * @var $productForm \catalog\models\product\ProductForm
 */

$this->title = Yii::t('app', 'Update Product: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <?= $this->render('_form', compact('model', 'currencyList', 'promocodesList', 'productForm')) ?>

</div>
