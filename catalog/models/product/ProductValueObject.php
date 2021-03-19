<?php


namespace catalog\models\product;

/**
 * Class ProductValueObject
 * @package catalog\models\product
 */
class ProductValueObject
{
    public $id;
    public $name;
    public $slug;
    public $price;
    public $old_price;
    public $currency_id;
    public $status;
    public $promocode_id;
    public $promo_status;
    public $created_at;
    public $updated_at;

    /** @var Product */
    private $_product;

    public function __construct(Product $product)
    {
        $this->_product = $product;
    }

    public function getId()
    {
        return $this->id = $this->_product->{$id};
    }
}