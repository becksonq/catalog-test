<?php


namespace catalog\models\product;


use catalog\models\currency\Currency;
use yii\base\Model;

/**
 * Форма создания и редактирования продукта
 *
 * Class ProductForm
 * @package catalog\models\product
 */
class ProductForm extends Model
{
    public $name;
    public $slug;
//    public $price;
    public $status;
    public $promocode_id;
    public $promo_status;
    public $created_at;
    public $updated_at;

    private $_product;

    /**
     * ProductForm constructor.
     * @param Product|null $product
     * @param array $config
     */
    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->name = $product->name;
            $this->slug = $product->slug;
//            $this->price = $product->price;
            $this->promocode_id = $product->promocode_id;
            $this->_product = $product;
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['status', 'created_at', 'updated_at', 'promocode_id', 'promo_status',], 'integer'],
//            [['price',], 'double'],
            [['name', 'slug'], 'string', 'max' => 255],
            [
                ['slug'],
                'unique',
                'targetClass' => Product::class,
                'filter'      => $this->_product ? ['<>', 'id', $this->_product->id] : null
            ],
//            [
//                ['currency_id'],
//                'exist',
//                'skipOnError' => true,
//                'targetClass' => Currency::class,
//                'targetAttribute' => ['currency_id' => 'id']
//            ],
        ];
    }
}