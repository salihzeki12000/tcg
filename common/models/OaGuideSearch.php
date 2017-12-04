<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaGuide;

/**
 * OaGuideSearch represents the model behind the search form about `common\models\OaGuide`.
 */
class OaGuideSearch extends OaGuide
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'rating', 'city_id', 'agency'], 'integer'],
            [['name', 'language', 'contact_info', 'identity_bank_info', 'cl_english', 'note'], 'safe'],
            [['daily_price'], 'number'],
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
        $query = OaGuide::find();

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
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'daily_price' => $this->daily_price,
            'city_id' => $this->city_id,
            'agency' => $this->agency,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'contact_info', $this->contact_info])
            ->andFilterWhere(['like', 'identity_bank_info', $this->identity_bank_info])
            ->andFilterWhere(['like', 'cl_english', $this->cl_english])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
