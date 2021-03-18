<?php


namespace catalog\models\product;

use catalog\models\currency\Currency;
use catalog\modules\promocode\models\Promocode;
use catalog\modules\promocode\models\PromocodeRepository;
use Yii;

/**
 * Class ProductService
 * @package catalog\models\product
 */
class ProductService
{
    /** @var ProductRepository $_repository */
    private $_repository;

    /** @var PromocodeRepository $_promocodeRepository */
    private $_promocodeRepository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     * @param PromocodeRepository $promocodeRepository
     */
    public function __construct(ProductRepository $repository, PromocodeRepository $promocodeRepository)
    {
        $this->_repository = $repository;
        $this->_promocodeRepository = $promocodeRepository;
    }

    /**
     * @param ProductForm $form
     * @return Product
     */
    public function create(ProductForm $form): Product
    {
        $product = Product::create(
            $form->name,
            $form->slug,
            $form->price,
            $form->promocode_id
        );
        $this->_repository->save($product);
        return $product;
    }

    /**
     * @param int $id
     * @param ProductForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit(int $id, ProductForm $form)
    {
        $product = $this->_repository->getById($id);
        $product->edit(
            $form->name,
            $form->slug,
            $form->price,
            $form->promocode_id
        );

        $this->_repository->save($product);
    }

    /**
     * @return \yii\data\DataProviderInterface
     */
    public function findAll()
    {
        return $this->_repository->getAll();
    }

    /**
     * Получаем данные для json
     *
     * @return array
     */
    public function jsonData(): array
    {
        $data = [];
        $dataProvider = $this->_repository->getJsonData();
        foreach ($dataProvider->getModels() as $model){
           $data['pages'][] = $model;
        }
        $data['pagination'] = $dataProvider->pagination;

        return $data;
    }

    /**
     * Применяем скидку
     *
     * @param string $name
     */
    public function applyPromocode(string $name): void
    {
        $promocode = $this->_promocodeRepository->getByName($name);
        if ($promocode == null) {
            throw new \DomainException('Promo code not found');
        }

        $products = $this->_repository->getByPromocode($promocode->id);
        foreach ($products as $product) {
            $product->promo_status = Product::PROMO_APPLY;
            $product->old_price = $product->price;
            $product->price = $this->createDiscount($product);
            $this->_repository->save($product);
        }
    }

    /**
     * Получаем цену со скидкой
     *
     * @param Product $product
     * @return float|int|null
     */
    protected function createDiscount(Product $product)
    {
        if ($product->promocode->type == Promocode::RUBLE_DISCOUNT) {
            if ($product->currency->type == Currency::ORIGIN_PRICE) {
                $price = $product->price - $product->promocode->value;
            }
            if ($product->currency->type == Currency::EURO_PRICE
                || $product->currency->type == Currency::DOLLAR_PRICE) {
                $rublePrice = $product->price * $product->currency->rate;
                $rublePrice = $rublePrice - $product->promocode->value;
                $price = $rublePrice / $product->currency->rate;
            }
        }

        if ($product->promocode->type == Promocode::PERCENT_DISCOUNT) {
            $price = $product->price - ($product->price * ($product->promocode->value * .01));
        }
        if ($product->currency->type == Currency::EURO_PRICE
            || $product->currency->type == Currency::DOLLAR_PRICE) {
            $rublePrice = $product->price * $product->currency->rate;
            $rublePrice = $rublePrice - (($product->promocode->value * .01) * $rublePrice);
            $price = $rublePrice / $product->currency->rate;
        }

        return $price;
    }

    /**
     * @param int $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function removeDiscount(int $id): void
    {
        $model = $this->_repository->getById($id);
        $model->promo_status = 0;
        $model->price = $model->old_price;
        $model->old_price = null;
        $this->_repository->save($model);
    }

    /**
     * @return array
     */
    public function statusList(): array
    {
        return [
            Product::STATUS_DRAFT  => 'Черновик',
            Product::STATUS_ACTIVE => 'Активное',
        ];
    }

}