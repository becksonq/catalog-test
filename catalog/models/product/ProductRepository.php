<?php

namespace catalog\models\product;

use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

/**
 * Class ProductRepository
 * @package catalog\models\product
 */
class ProductRepository
{
    /**
     * @return DataProviderInterface
     */
    public function getAll(): DataProviderInterface
    {
        $query = Product::find()->alias('p')
            ->where(['status' => Product::STATUS_ACTIVE])
            ->with('currency')
            ->orderBy(['p.created_at' => SORT_DESC]);
        return $this->_getProvider($query);
    }

    /**
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
    private function _getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes'   => [
                    'id',
                    'price' => [
                        'asc'  => ['p.price_new' => SORT_ASC],
                        'desc' => ['p.price_new' => SORT_DESC],
                    ],
                ],
            ],
        ]);
    }
}