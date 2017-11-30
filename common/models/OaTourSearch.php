<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaTour;

/**
 * OaTourSearch represents the model behind the search form about `common\models\OaTour`.
 */
class OaTourSearch extends OaTour
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inquiry_id', 'vip', 'tour_type', 'number_of_travelers'], 'integer'],
            [['create_time', 'update_time', 'inquiry_source', 'language', 'agent', 'co-agent', 'operator', 'group_type', 'country', 'organization', 'traveler_info', 'tour_start_date', 'tour_end_date', 'cities', 'contact', 'email', 'other_contact_info', 'itinerary_quotation_english', 'itinerary_quotation_other_language', 'tour_schedule_note', 'note_for_guide', 'other_note', 'payment', 'stage'], 'safe'],
            [['tour_price'], 'number'],
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
        $query = OaTour::find();

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
            'inquiry_id' => $this->inquiry_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'vip' => $this->vip,
            'tour_type' => $this->tour_type,
            'number_of_travelers' => $this->number_of_travelers,
            'tour_price' => $this->tour_price,
        ]);

        $query->andFilterWhere(['like', 'inquiry_source', $this->inquiry_source])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'co-agent', $this->co-agent])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'group_type', $this->group_type])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'traveler_info', $this->traveler_info])
            ->andFilterWhere(['like', 'tour_start_date', $this->tour_start_date])
            ->andFilterWhere(['like', 'tour_end_date', $this->tour_end_date])
            ->andFilterWhere(['like', 'cities', $this->cities])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'other_contact_info', $this->other_contact_info])
            ->andFilterWhere(['like', 'itinerary_quotation_english', $this->itinerary_quotation_english])
            ->andFilterWhere(['like', 'itinerary_quotation_other_language', $this->itinerary_quotation_other_language])
            ->andFilterWhere(['like', 'tour_schedule_note', $this->tour_schedule_note])
            ->andFilterWhere(['like', 'note_for_guide', $this->note_for_guide])
            ->andFilterWhere(['like', 'other_note', $this->other_note])
            ->andFilterWhere(['like', 'payment', $this->payment])
            ->andFilterWhere(['like', 'stage', $this->stage]);

        return $dataProvider;
    }
}
