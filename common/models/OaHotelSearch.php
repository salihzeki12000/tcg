<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaHotel;

/**
 * OaHotelSearch represents the model behind the search form about `common\models\OaHotel`.
 */
class OaHotelSearch extends OaHotel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'rating'], 'integer'],
            [['name', 'level', 'tripadvisor_link', 'rooms_prices', 'contact_person_info', 'bank_info', 'cl_english', 'note'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = OaHotel::find();

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
            'id' => $this->id,
            'city_id' => $this->city_id,
            'rating' => $this->rating,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'tripadvisor_link', $this->tripadvisor_link])
            ->andFilterWhere(['like', 'rooms_prices', $this->rooms_prices])
            ->andFilterWhere(['like', 'contact_person_info', $this->contact_person_info])
            ->andFilterWhere(['like', 'bank_info', $this->bank_info])
            ->andFilterWhere(['like', 'cl_english', $this->cl_english])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
