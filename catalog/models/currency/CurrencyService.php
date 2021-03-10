<?php


namespace catalog\models\currency;

use yii\helpers\ArrayHelper;

/**
 * Class CurrencyService
 * @package catalog\models\currency
 */
class CurrencyService
{
    /** @var CurrencyRepository $_repository */
    private $_repository;

    /**
     * CurrencyService constructor.
     * @param CurrencyRepository $repository
     */
    public function __construct(CurrencyRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @return array|Currency[]
     */
    public function findAll(): array
    {
        return $this->_repository->getAll();
    }

    /**
     * Массив валюты для выпадающего списка
     * @return array
     */
    public function currencyList(): array
    {
        $models = $this->_repository->getAll();
        return ArrayHelper::map($models, 'id', 'type');
    }
}