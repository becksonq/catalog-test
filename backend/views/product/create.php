<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $productForm catalog\models\product\ProductForm
 * @var $currencyList array
 * @var $promocodesList array
 */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', compact('productForm', 'currencyList', 'promocodesList')) ?>

</div>
