<?php


namespace catalog\modules\promocode\models;

use catalog\models\product\Product;

/**
 * Class PromocodeForm
 * @package catalog\modules\promocode\models
 */
class PromocodeForm extends \yii\base\Model
{
    public $name;
    public $value;
    public $type;
    public $start;
    public $end;

    /** @var array */
    public $products;

    /**
     * PromocodeForm constructor.
     * @param Promocode|null $promocode
     * @param array $config
     */
    public function __construct(Promocode $promocode = null, $config = [])
    {
        if ($promocode) {
            $this->name = $promocode->name;
            $this->value = $promocode->value;
            $this->type = $promocode->type;
            $this->start = $promocode->start;
            $this->end = $promocode->end;
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'value', 'type'], 'required'],
            [['start', 'end', 'value', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['products'], 'safe'],
        ];
    }
}