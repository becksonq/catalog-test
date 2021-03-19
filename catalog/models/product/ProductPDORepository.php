<?php

namespace catalog\models\product;

use yii\web\NotFoundHttpException;
use Yii;

/**
 * Class ProductRepository
 * @package catalog\models\product
 *
 * @todo Реализовать интерфейс
 * @todo Вынести подключение к базе данных в контейнер
 */
class ProductPDORepository
{
    /** @var $tableName */
    protected $tableName;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->tableName = Product::tableName();
    }

    /**
     * @param $id
     * @return array|\yii\db\DataReader
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function getOne($id)
    {
        $product = Yii::$app->db->createCommand('SELECT * FROM ' . $this->tableName . ' WHERE id=:id')
            ->bindValue(':id', $id)
            ->queryOne();
        if (!$product) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $product;
    }

    /**
     * @param array $product
     * @throws \yii\db\Exception
     */
    public function save(array $product): void
    {
        if (!Yii::$app->db->createCommand()->insert($this->tableName, $product)->execute()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function saveAll()
    {
        //@todo
    }

    /**
     * @param Product $product
     * @throws \yii\db\Exception
     */
    public function remove(Product $product)
    {
        if (!Yii::$app->db->createCommand()->delete($this->tableName, 'id=' . $product->id)->execute()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}