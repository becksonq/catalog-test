<?php


namespace catalog\models\product;

/**
 * Class ProductDecorator
 * @package catalog\models\product
 */
class ProductDecorator
{
    private $_product;
    private $_currency;
    private $_promocode;
    private $_productIdArray;

    /**
     * ProductDecorator constructor.
     * @param $product
     * @param $currency
     */
    public function __construct($product, $currency, $promocode)
    {
        $this->_product = $product;
        $this->_currency = $currency;
        $this->_promocode = $promocode;
        $this->_productIdArray = (\Yii::$app->session->get($this->_promocode->name)) ?: [];
    }

    /**
     * @param $product
     * @param $currency
     * @return ProductDecorator
     */
    public static function decorate($product, $currency, $promocode): self
    {
        return new self($product, $currency, $promocode);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $methodName = 'get' . $name;
        if (method_exists(self::class, $methodName)) {
            return $this->$methodName();
        } else {
            return $this->_product->{$name};
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->_product->$name($arguments);
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return sprintf("%.2f", $this->_product->price);
    }

    /**
     * @return string
     * @todo rename method
     */
    public function getOld_Price(): string
    {
        $html = '';
        if ($this->_product->old_price !== null) :
            $html .= '<del>' . sprintf("%.2f", $this->_product->old_price) . '</del>';
        endif;
        return $html;
    }

    /**
     * @return string
     */
    public function getRublePrice(): string
    {
        $html = '';
        if ($this->_currency->type !== \catalog\models\currency\Currency::ORIGIN_PRICE) :
            $html .= '<p class="card-text">Цена в рублях: ' . sprintf("%.2f",
                    ($this->_product->price * $this->_currency->rate)) . ' руб.</p>';
        endif;
        return $html;
    }

    /**
     * @return string
     */
    public function getPromocode(): string
    {
        $html = '';
        // Если есть промокод но он не применен
        if ($this->_product->promocode_id !== null) {
            $html = '<p class="card-text text-primary">Доступен промокод</p>';
        }
        if ($this->_product->promocode_id !== null && in_array($this->_product->id, $this->_productIdArray)) {
            $html = '<p class="card-text text-success">Применен промокод - ' . $this->_promocode->name . '</p>';
        }

        return $html;
    }
}