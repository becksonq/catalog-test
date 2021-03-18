<?php


namespace catalog\modules\promocode\models;


use catalog\models\product\Product;

/**
 * Class ProductHtmlHelper
 * @package catalog\modules\promocode\models
 */
class ProductHtmlHelper
{
    /**
     * @param Product $model
     * @return string
     */
    public static function isPromocode(Product $model): string
    {
        $html = '';
        // Если есть промокод но он не применен
        if ($model->promocode_id !== null && $model->promo_status == Product::PROMO_NOT_APPLY) {
            $html = '<p class="card-text text-primary">Доступен промокод</p>';
        }
        if ($model->promocode_id !== null && $model->promo_status == Product::PROMO_APPLY) {
            $html = '<p class="card-text text-success">Промокод применен</p>';
        }

        return $html;
    }
}