<?php


namespace catalog\models\product;


use catalog\models\currency\CurrencyDto;
use catalog\modules\promocode\models\PromocodeRepository;
use catalog\modules\promocode\models\store\StoreInterface;
use Yii;
use yii\helpers\ArrayHelper;

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

    /** @var ProductReadRepository */
    private $_productReadRepository;

    /** @var ProductValueObject
     * @todo реализовать класс
     */
    private $_productValueObject;

    /** @var StoreInterface */
    private $_discountStore;

    /** @var PriceCalculator */
    private $_calculator;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     * @param ProductReadRepository $productReadRepository
     * @param PromocodeRepository $promocodeRepository
     * @param ProductValueObject $productValueObject
     * @param StoreInterface $discountStore
     * @param PriceCalculator $calculator
     */
    public function __construct(
        ProductRepository $repository,
        ProductReadRepository $productReadRepository,
        PromocodeRepository $promocodeRepository,
        ProductValueObject $productValueObject,
        StoreInterface $discountStore,
        PriceCalculator $calculator
    ) {
        $this->_repository = $repository;
        $this->_promocodeRepository = $promocodeRepository;
        $this->_productReadRepository = $productReadRepository;
        $this->_productValueObject = $productValueObject;
        $this->_discountStore = $discountStore;
        $this->_calculator = $calculator;
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
    public function edit(int $id, ProductForm $form): void
    {
        $product = $this->_productReadRepository->getById($id);
        $product->edit(
            $form->name,
            $form->slug,
            $form->price,
            $form->promocode_id
        );

        $this->_repository->save($product);
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $products = [];
        $dataProvider = $this->_productReadRepository->getAll();
        foreach ($dataProvider->getModels() as $model) {
            $model = $this->_calculator->setDiscount($model);
            $product = ProductDto::make($model);
            $currency = CurrencyDto::make($model->currency);
            $product = ProductDecorator::decorate($product, $currency, $model->promocode);
            $products[] = $product;
        }

        return $products;
    }

    /**
     * Получаем данные для json
     *
     * @return array
     */
    public function jsonData(): array
    {
        $data = [];
        $dataProvider = $this->_productReadRepository->getJsonData();
        foreach ($dataProvider->getModels() as $model) {
            $data['pages'][] = $model;
        }
        $data['pagination'] = $dataProvider->pagination;

        return $data;
    }

    /**
     * Применяем скидку
     *
     * @param string $name
     * @return bool|null
     */
    public function applyPromocode(string $discountName)
    {
        $promocode = $this->_promocodeRepository->getByName($discountName);
        if ($promocode == null) {
            return null;
//            throw new \DomainException('Promo code not found');
        }

        $products = $this->_productReadRepository->getByPromocode($promocode->id);
        foreach ($products as $product) {
            $this->_repository->save($product);
            $idArray[] = $product->id;
        }
        $this->_discountStore->applyDiscount($discountName, $idArray);

        return true;
    }

    /**
     * @param int $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function removeDiscount(int $id): void
    {
        $product = $this->_productReadRepository->getById($id);
        $this->_discountStore->removeDiscount($product->promocode->name, $product);
    }

    /**
     * @return array$products
     */
    public function productList(): array
    {
        $products = $this->_productReadRepository->getAllModels();
        return ArrayHelper::map($products, 'id', 'name');
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