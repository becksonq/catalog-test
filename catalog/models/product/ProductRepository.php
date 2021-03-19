<?php

namespace catalog\models\product;


use yii\web\NotFoundHttpException;

/**
 * Class ProductRepository
 * @package catalog\models\product
 */
class ProductRepository
{
    /** @var Product $product */
    protected $product;

    /**
     * ProductRepository constructor.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param $id
     * @return Product
     * @throws NotFoundHttpException
     */
    public function getOne($id): Product
    {
        if (!$product = $this->product->findOne($id)) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $product;
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Product $product
     * @throws \yii\db\Exception
     */
    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}