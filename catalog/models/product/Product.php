<?php

namespace catalog\models\product;

use catalog\models\currency\Currency;
use catalog\modules\promocode\models\Promocode;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property float|null $price
 * @property float|null $old_price
 * @property int|null $currency_id
 * @property int|null $status
 * @property int $promocode_id
 * @property boolean $promo_status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Currency $currency
 * @property Promocode $promocode
 */
class Product extends \yii\db\ActiveRecord
{
    /** @var int Статус черновика */
    const STATUS_DRAFT = 0;

    /** @var int Статус активного продукта */
    const STATUS_ACTIVE = 1;

    /** @var int Промокод не применен */
    const PROMO_NOT_APPLY = 0;

    /** @var int Промокод применен */
    const PROMO_APPLY = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'slug'      => [
                'class'                => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute'        => 'slug',
                'attribute'            => 'name',
                // optional params
                'ensureUnique'         => true,
                'replacement'          => '-',
                'lowercase'            => true,
                'immutable'            => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['currency_id', 'status', 'created_at', 'updated_at', 'promocode_id', 'promo_status',], 'integer'],
            [['price', 'old_price',], 'double'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_DRAFT],
            [
                'price',
                'required',
                'when'       => function ($model) {
                    return $model->status == self::STATUS_ACTIVE;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#status').val() == 1;
                }"
            ],
            [
                ['currency_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Currency::className(),
                'targetAttribute' => ['currency_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'name'         => Yii::t('app', 'Name'),
            'slug'         => Yii::t('app', 'Slug'),
            'price'        => Yii::t('app', 'Price'),
            'old_price'    => Yii::t('app', 'Old Price'),
            'currency_id'  => Yii::t('app', 'Currency ID'),
            'status'       => Yii::t('app', 'Status'),
            'promocode_id' => Yii::t('app', 'Promocode'),
            'promo_status' => Yii::t('app', 'Promo Status'),
            'created_at'   => Yii::t('app', 'Created At'),
            'updated_at'   => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocode()
    {
        return $this->hasOne(Promocode::class, ['id' => 'promocode_id']);
    }
}
