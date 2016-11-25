<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tour;

/**
 * TourSearch represents the model behind the search form about `common\models\Tour`.
 */
class TourSearch extends Tour
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'cities_count', 'priority', 'exp_num'], 'integer'],
            [['name', 'code', 'themes', 'cities', 'overview', 'best_season', 'pic_map', 'pic_title', 'inclusion', 'exclusion', 'tips', 'keywords', 'link_tour', 'create_time', 'update_time'], 'safe'],
            [['tour_length', 'price_cny', 'price_usd'], 'number'],
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
        $query = Tour::find();

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
            'status' => $this->status,
            'cities_count' => $this->cities_count,
            'priority' => $this->priority,
            'tour_length' => $this->tour_length,
            'exp_num' => $this->exp_num,
            'price_cny' => $this->price_cny,
            'price_usd' => $this->price_usd,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'themes', $this->themes])
            ->andFilterWhere(['like', 'cities', $this->cities])
            ->andFilterWhere(['like', 'overview', $this->overview])
            ->andFilterWhere(['like', 'best_season', $this->best_season])
            ->andFilterWhere(['like', 'pic_map', $this->pic_map])
            ->andFilterWhere(['like', 'pic_title', $this->pic_title])
            ->andFilterWhere(['like', 'inclusion', $this->inclusion])
            ->andFilterWhere(['like', 'exclusion', $this->exclusion])
            ->andFilterWhere(['like', 'tips', $this->tips])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'link_tour', $this->link_tour]);

        return $dataProvider;
    }
}