<?php


namespace catalog\models\product;

/**
 * Class ProductService
 * @package catalog\models\product
 */
class ProductService
{
    /** @var ProductRepository $_repository */
    private $_repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->_repository = $repository;
    }

    /**
     * @return \yii\data\DataProviderInterface
     */
    public function findAll()
    {
        return $this->_repository->getAll();
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