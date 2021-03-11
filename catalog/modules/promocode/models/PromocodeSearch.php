<?php

namespace catalog\modules\promocode\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use catalog\modules\promocode\models\Promocode;

/**
 * PromocodeSearch represents the model behind the search form of `catalog\modules\promocode\models\Promocode`.
 */
class PromocodeSearch extends Promocode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'start', 'end', 'value', 'type'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Promocode::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'    => $this->id,
            'start' => $this->start,
            'end'   => $this->end,
            'value' => $this->value,
            'type'  => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
