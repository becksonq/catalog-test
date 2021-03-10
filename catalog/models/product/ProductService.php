<?php


namespace catalog\models\product;

/**
 * Class ProductService
 * @package catalog\models\product
 */
class ProductService
{
    /**
     * @return array
     */
    public function statusList(): array
    {
        return [
            Product::STATUS_DRAFT => 'Черновик',
            Product::STATUS_ACTIVE => 'Активное',
        ];
    }
}