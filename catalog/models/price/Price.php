<?php

namespace catalog\models\price;

use catalog\models\product\Product;
use catalog\models\product\ProductQuery;
use Yii;

/**
 * This is the model class for table "{{%prices}}".
 *
 * @property int $id
 * @property float|null $price
 * @property float|null $oldprice
 * @property int $currency_id
 *
 * @property Product $product
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'price'       => Yii::t('app', 'Price'),
            'oldprice'    => Yii::t('app', 'Oldprice'),
            'currency_id' => Yii::t('app', 'Currency ID'),
        ];
    }

    public static function create($price, $oldprice, $currencyId)
    {
        $price = new static();
        $price->price = $price;
        $price->oldprice = $oldprice;
        $price->currency_id = $currencyId;
        return $price;
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['price_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }
}
