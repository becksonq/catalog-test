<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use catalog\models\product\Product;

/* @var $this yii\web\View */
/* @var $searchModel catalog\models\product\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider
 * @var $currencyList array
 * @var $statusList array
 * @var $promocodesList array
 */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [
                'attribute' => 'id',
                'options'   => ['width' => '10']
            ],
            'name',
            'slug',
            [
                'attribute' =>    'price_id',
                'header' => 'Price',
                'value' => 'price.price',
                'options'   => ['width' => '100'],
            ],
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function (Product $model) use ($statusList) {
                    return $statusList[$model->status];
                },
                'filter'    => $statusList,
                'options'   => ['width' => '100'],
            ],
            [
                'header' => '<i class="fa fa-refresh" aria-hidden="true"></i>',
                'format' => 'raw',
                'value'  => function (Product $model) {
                    return Html::a('<i class="fa fa-refresh" aria-hidden="true"></i>',
                        ['status', 'status' => $model->status, 'id' => $model->id], [
                            'class' => 'btn btn-success',
                            'title' => 'Изменить статус'
                        ]);
                }
            ],
            [
                'attribute' => 'promocode_id',
                'value'     => function (Product $model) use ($promocodesList) {
                    return $promocodesList[$model->promocode_id];
                },
                'filter'    => $promocodesList,
            ],
            [
                'attribute' => 'promo_status',
                'value' => function (Product $model) {
                    return $model->promo_status == 0 ? 'No' : 'Yes';
                },
                'filter' => ['1' => 'Yes', '0' => 'No'],
            ],
//            'created_at:dateTime',
            //'updated_at:dateTime',

            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
