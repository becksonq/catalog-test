<?php

namespace catalog\modules\promocode\models;

use catalog\models\product\Product;
use catalog\models\product\ProductQuery;
use Yii;

/**
 * This is the model class for table "{{%promocodes}}".
 *
 * @property int $id
 * @property string $name
 * @property integer $value
 * @property integer $type Тип скидки (в рублях или процентах)
 * @property int|null $start Дата начала действия промокода
 * @property int|null $end Дата окончания действия промокода
 *
 * @property Product[] $products
 */
class Promocode extends \yii\db\ActiveRecord
{
    /** @var int Скидка в процентах */
    const PERCENT_DISCOUNT = 0;

    /** @var int Скидка в рублях */
    const RUBLE_DISCOUNT = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%promocodes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => Yii::t('app', 'ID'),
            'name'  => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'type'  => Yii::t('app', 'Type'),
            'start' => Yii::t('app', 'Start'),
            'end'   => Yii::t('app', 'End'),
        ];
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @param $start
     * @param $end
     * @return static
     */
    public static function create($name, $value, $type, $start, $end): self
    {
        $promocode = new static();
        $promocode->name = $name;
        $promocode->value = $value;
        $promocode->type = $type;
        $promocode->start = $start;
        $promocode->end = $end;
        return $promocode;
    }

    /**
     * @param $name
     * @param $value
     * @param $type
     * @param $start
     * @param $end
     */
    public function edit($name, $value, $type, $start, $end): void
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['promocode_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PromocodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromocodeQuery(get_called_class());
    }
}
