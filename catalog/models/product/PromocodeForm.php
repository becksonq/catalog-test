<?php


namespace catalog\models\product;

/**
 * Форма введения промокода
 *
 * Class PromocodeForm
 * @package catalog\modules\promocode\models
 */
class PromocodeForm extends \yii\base\Model
{
    /** @var string */
    public $name;

    /**
     * PromocodeForm constructor.
     * @param Product|null $product
     * @param array $config
     */
    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->quantity = $product->quantity;
        }
        parent::__construct($config);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }
}