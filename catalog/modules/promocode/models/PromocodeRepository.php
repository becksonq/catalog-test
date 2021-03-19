<?php


namespace catalog\modules\promocode\models;

use yii\web\NotFoundHttpException;

/**
 * Class PromocodeRepository
 * @package catalog\modules\promocode\models
 */
class PromocodeRepository
{
    /** @var Promocode $model */
    protected $model;

    /**
     * PromocodeRepository constructor.
     * @param Promocode $model
     */
    public function __construct(Promocode $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return Promocode|null
     * @throws NotFoundHttpException
     */
    public function getById(int $id)
    {
        if (!$promocode = $this->model->findOne($id)) {
            throw new NotFoundHttpException('Product is not found.');
        }
        return $promocode;
    }

    /**
     * @return array|Promocode[]
     */
    public function getAll()
    {
        return $this->model->find()->all();
    }

    /**
     * @param string $name
     * @return Promocode|null
     */
    public function getByName(string $name)
    {
        return $this->model->findOne(['name' => $name]);
    }

    /**
     * @param Promocode $promocode
     */
    public function save(Promocode $promocode): void
    {
        if (!$promocode->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Promocode $promocode
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Promocode $promocode): void
    {
        if (!$promocode->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}