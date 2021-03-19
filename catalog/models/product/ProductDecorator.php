<?php


namespace catalog\models\product;

/**
 * Class ProductDecorator
 * @package catalog\models\product
 */
class ProductDecorator
{
    /** @var $_product */
    private $_product;

    private $_currency;

    /**
     * ProductDecorator constructor.
     * @param $product
     * @param $currency
     */
    public function __construct($product, $currency)
    {
        $this->_product = $product;
        $this->_currency = $currency;
    }

    /**
     * @param $product
     * @param $currency
     * @return ProductDecorator
     */
    public static function decorate($product, $currency): self
    {
        return new self($product, $currency);
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
        if ($this->_product->promocode_id !== null && $this->_product->promo_status == Product::PROMO_NOT_APPLY) {
            $html = '<p class="card-text text-primary">Доступен промокод</p>';
        }
        if ($this->_product->promocode_id !== null && $this->_product->promo_status == Product::PROMO_APPLY) {
            $html = '<p class="card-text text-success">Промокод применен</p>';
        }

        return $html;
    }
}