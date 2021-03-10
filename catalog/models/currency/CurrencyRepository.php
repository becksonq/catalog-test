<?php


namespace catalog\models\currency;

/**
 * Class CurrencyRepository
 * @package catalog\models\currency
 */
class CurrencyRepository
{
    /**
     * @return array|Currency[]
     */
    public function getAll(): array
    {
        return Currency::find()->all();
    }
}