<?php


namespace catalog\modules\promocode\models;

use catalog\models\product\ProductRepository;
use yii\helpers\ArrayHelper;

/**
 * Class PromocodeService
 * @package catalog\modules\promocode\models
 */
class PromocodeService
{
    /** @var PromocodeRepository $_repository */
    private $_repository;

    /** @var ProductRepository $_productRepository */
    private $_productRepository;

    /**
     * PromocodeService constructor.
     * @param PromocodeRepository $repository
     * @param ProductRepository $productRepository
     */
    public function __construct(PromocodeRepository $repository, ProductRepository $productRepository)
    {
        $this->_repository = $repository;
        $this->_productRepository = $productRepository;
    }

    /**
     * @param PromocodeForm $form
     * @return Promocode
     */
    public function create(PromocodeForm $form): Promocode
    {
        $promocode = Promocode::create(
            $form->name,
            $form->value,
            $form->type,
            $form->start,
            $form->end
        );
        $this->_repository->save($promocode);
        $this->updateProducts($form->products, $promocode->id);

        return $promocode;
    }

    /**
     * @param int $id
     * @param PromocodeForm $form
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit(int $id, PromocodeForm $form): void
    {
        $promocode = $this->_repository->getById($id);
        $promocode->edit(
            $form->name,
            $form->value,
            $form->type,
            $form->start,
            $form->end
        );
        $this->_repository->save($promocode);
        $this->updateProducts($form->products, $promocode->id);
    }

    /**
     * @param array $products
     * @param int $promodoceId
     * @throws \yii\web\NotFoundHttpException
     */
    protected function updateProducts(array $products, int $promodoceId): void
    {
        foreach ($products as $id) {
            $product = $this->_productRepository->getOne((int)$id);
            $product->promocode_id = $promodoceId;
            $this->_productRepository->save($product);
        }
    }

    /**
     * @param int $id
     * @return Promocode|null
     * @throws \yii\web\NotFoundHttpException
     */
    public function findById(int $id)
    {
        return $this->_repository->getById($id);
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