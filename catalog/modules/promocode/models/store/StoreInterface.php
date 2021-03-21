<?php


namespace catalog\modules\promocode\models\store;

use catalog\models\product\Product;

/**
 * Interface StoreInterface
 * @package catalog\modules\promocode\models\store
 */
interface StoreInterface
{
    public function applyDiscount(string $name, array $idArray): void;
    public function removeDiscount(string $name, Product $product): void;
}