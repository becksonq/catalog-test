<?php

namespace catalog\models\product;

use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * Class ProductRepository
 * @package catalog\models\product
 */
class ProductRepository
{
    /**
     * @param $id
     * @return Product
     * @throws NotFoundHttpException
     */
    public function getById($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $product;
    }

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

    public function getJsonData()
    {
        $query = Product::find()->alias('p')
            ->where(['status' => Product::STATUS_ACTIVE])
            ->with('currency')
            ->orderBy(['p.created_at' => SORT_DESC])
            ->asArray();
        return $this->_getProvider($query);
    }

    /**
     * @param int $promocodeId
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getByPromocode(int $promocodeId)
    {
        return Product::find()
            ->where(['promocode_id' => $promocodeId])
            ->andWhere(['promo_status' => Product::PROMO_NOT_APPLY])
            ->all();
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

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}