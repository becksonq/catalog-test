<?php


namespace catalog\modules\promocode\models\store;


use catalog\models\product\Product;

class DbStoreDiscount implements StoreInterface
{

    public function applyDiscount(string $name, array $idArray): void
    {
        // TODO: Implement applyDiscount() method.
    }

    public function removeDiscount(string $name, Product $product): void
    {
        // TODO: Implement getProductId() method.
    }
}