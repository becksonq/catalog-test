<?php


namespace catalog\models\product;


use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

/**
 * Class ProductReadRepository
 * @package catalog\modules\promocode\models
 */
class ProductReadRepository
{
    /** @var $tableName */
    protected $product;

    /**
     * ProductRepository constructor.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param $id
     * @return \catalog\models\product\Product|null
     */
    public function getById($id)
    {
        if (!$product = $this->product->findOne($id)) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $product;
    }

    /**
     * @return DataProviderInterface
     */
    public function getAll(): DataProviderInterface
    {
        $query = $this->product->find()->alias('p')
            ->where(['status' => Product::STATUS_ACTIVE])
            ->with('currency')
            ->orderBy(['p.created_at' => SORT_DESC]);
        return $this->_getProvider($query);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllModels()
    {
        return $this->product->find()->all();
    }

    public function getJsonData()
    {
        $query = $this->product->find()->alias('p')
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
        return $this->product->find()
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
}