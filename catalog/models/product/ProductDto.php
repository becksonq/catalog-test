<?php


namespace catalog\models\product;

/**
 * Class ProductDto
 * @package catalog\models\product
 */
class ProductDto
{
    /** @var object $_product */
    private $_product;

    /**
     * ProductDto constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->_product = (object)$model->toArray();
    }

    /**
     * @param $model
     * @return ProductDto
     */
    public static function make($model): self
    {
        return new self($model);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->_product->{$name};
    }
}