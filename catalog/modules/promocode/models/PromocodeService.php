<?php


namespace catalog\modules\promocode\models;

use yii\helpers\ArrayHelper;

/**
 * Class PromocodeService
 * @package catalog\modules\promocode\models
 */
class PromocodeService
{
    /** @var PromocodeRepository $_repository */
    private $_repository;

    /**
     * PromocodeService constructor.
     * @param PromocodeRepository $repository
     */
    public function __construct(PromocodeRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @return array
     */
    public function promocodesList()
    {
        $models = $this->_repository->getAll();
        return ArrayHelper::map($models, 'id', 'name');
    }

    /**
     * @return array
     */
    public static function discountList(): array
    {
        return [
            Promocode::PERCENT_DISCOUNT => 'Проценты',
            Promocode::RUBLE_DISCOUNT   => 'Рубли',
        ];
    }
}