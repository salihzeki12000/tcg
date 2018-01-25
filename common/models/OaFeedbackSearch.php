<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaFeedback;

/**
 * OaFeedbackSearch represents the model behind the search form about `common\models\OaFeedback`.
 */
class OaFeedbackSearch extends OaFeedback
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id'], 'integer'],
            [['language', 'create_time', 'comment_itinerary', 'comment_meals', 'comment_service_agent', 'comment_service_guide_driver', 'why_chose_us', 'rate', 'suggestions', 'client_name', 'client_email', 'agent'], 'safe'],
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
        $query = OaFeedback::find();

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
            'tour_id' => $this->tour_id,
            'create_time' => $this->create_time,
            'agent' => $this->agent,
        ]);

        $query->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'comment_itinerary', $this->comment_itinerary])
            ->andFilterWhere(['like', 'comment_meals', $this->comment_meals])
            ->andFilterWhere(['like', 'comment_service_agent', $this->comment_service_agent])
            ->andFilterWhere(['like', 'comment_service_guide_driver', $this->comment_service_guide_driver])
            ->andFilterWhere(['like', 'why_chose_us', $this->why_chose_us])
            ->andFilterWhere(['like', 'rate', $this->rate])
            ->andFilterWhere(['like', 'suggestions', $this->suggestions])
            ->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'client_email', $this->client_email]);

        return $dataProvider;
    }
}
