<?php


namespace catalog\modules\promocode\models;

/**
 * Class PromocodeRepository
 * @package catalog\modules\promocode\models
 */
class PromocodeRepository
{
    /**
     * @return array|Promocode[]
     */
    public function getAll()
    {
        return Promocode::find()->all();
    }

    /**
     * @param string $name
     * @return Promocode|null
     */
    public function getByName(string $name)
    {
        return Promocode::findOne(['name' => $name]);
    }
}