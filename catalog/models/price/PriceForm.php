<?php


namespace catalog\models\price;

/**
 * Class PriceForm
 * @package catalog\models\price
 */
class PriceForm extends \yii\base\Model
{
    public $price;
    public $currency_id;

    public function __construct(Price $productPrice = null, $config = [])
    {
        if ($productPrice) {
            $this->price = $productPrice->price;
            $this->currency_id = $productPrice->currency_id;
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'oldprice'], 'number', 'min' => 0],
            [['currency_id'], 'required'],
            [['currency_id'], 'integer'],
        ];
    }

}