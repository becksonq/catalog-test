<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use catalog\modules\promocode\models\Promocode;
use catalog\modules\promocode\models\PromocodeService;

/* @var $this yii\web\View */
/* @var $searchModel catalog\modules\promocode\models\PromocodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Promocodes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocode-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Promocode'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [

            'id',
            'name',
            'value',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'value'     => function (Promocode $model) {
                    return PromocodeService::discountList()[$model->type];
                },
                'filter'    => PromocodeService::discountList(),
            ],
            'start',
            'end',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
