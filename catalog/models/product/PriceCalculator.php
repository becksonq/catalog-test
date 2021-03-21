<?php


namespace catalog\models\product;

use catalog\models\currency\Currency;
use catalog\modules\promocode\models\Promocode;
use Yii;

/**
 * Class PriceCalculator
 * @package catalog\models\product
 */
class PriceCalculator
{
    /**
     * @param Product $product
     * @return Product
     */
    public function setDiscount(Product $product): Product
    {
        $price = $oldPrice = $product->price;
        if ($this->isZero($price)) {
            return $product;
        }
        $productIdArray = (Yii::$app->session->get($product->promocode->name)) ?: [];

        if (in_array($product->id, $productIdArray)) {

            switch ($product->promocode->type) {
                case Promocode::RUBLE_DISCOUNT:
                    if ($product->currency->type == Currency::ORIGIN_PRICE) {
                        $product->price = $price - $product->promocode->value;
                        $product->old_price = $oldPrice;
                    }
                    if ($product->currency->type == Currency::EURO_PRICE
                        || $product->currency->type == Currency::DOLLAR_PRICE) {
                        $rublePrice = $product->price * $product->currency->rate;
                        $rublePrice = $rublePrice - $product->promocode->value;
                        $product->price = $rublePrice / $product->currency->rate;
                        $product->old_price = $oldPrice;
                    }
                    break;
                case Promocode::PERCENT_DISCOUNT:
                    if ($product->currency->type == Currency::ORIGIN_PRICE) {
                        $product->price = $price - ($price * ($product->promocode->value * .01));
                        $product->old_price = $oldPrice;
                    }
                    if ($product->currency->type == Currency::EURO_PRICE
                        || $product->currency->type == Currency::DOLLAR_PRICE) {
                        $rublePrice = $product->price * $product->currency->rate;
                        $rublePrice = $rublePrice - (($product->promocode->value * .01) * $rublePrice);
                        $product->price = $rublePrice / $product->currency->rate;
                        $product->old_price = $oldPrice;
                    }
                    break;
            }
        }

        return $product;
    }

    /**
     * @param $price
     * @return bool
     */
    protected function isZero($price)
    {
        return $price == 0;
    }
}