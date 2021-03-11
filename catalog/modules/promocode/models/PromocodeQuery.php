<?php

namespace catalog\modules\promocode\models;

/**
 * This is the ActiveQuery class for [[Promocode]].
 *
 * @see Promocode
 */
class PromocodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Promocode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Promocode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
