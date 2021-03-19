<?php


namespace catalog\models\currency;

/**
 * Class CurrencyDto
 * @package catalog\models\currency
 */
class CurrencyDto
{
    /** @var object $_currency */
    private $_currency;

    /**
     * ProductDto constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->_currency = (object)$model->toArray();
    }

    /**
     * @param $model
     * @return self
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
        return $this->_currency->{$name};
    }
}