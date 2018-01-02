<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaInquiry;

/**
 * OaInquirySearch represents the model behind the search form about `common\models\OaInquiry`.
 */
class OaInquirySearch extends OaInquiry
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_type', 'number_of_travelers', 'close', 'creator'], 'integer'],
            [['create_time', 'update_time', 'inquiry_source', 'language', 'priority', 'agent', 'co_agent', 'group_type', 'organization', 'country', 'traveler_info', 'tour_start_date', 'tour_end_date', 'cities', 'contact', 'email', 'other_contact_info', 'original_inquiry', 'follow_up_record', 'tour_schedule_note', 'other_note', 'probability', 'inquiry_status', 'close_report', 'task_remind', 'task_remind_date'], 'safe'],
            [['estimated_cny_amount'], 'number'],
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
        $query = OaInquiry::find();

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
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'tour_type' => $this->tour_type,
            'number_of_travelers' => $this->number_of_travelers,
            'estimated_cny_amount' => $this->estimated_cny_amount,
            'close' => $this->close,
            'creator' => $this->creator,
        ]);

        $query->andFilterWhere(['like', 'inquiry_source', $this->inquiry_source])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'co_agent', $this->co_agent])
            ->andFilterWhere(['like', 'group_type', $this->group_type])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'traveler_info', $this->traveler_info])
            ->andFilterWhere(['like', 'tour_start_date', $this->tour_start_date])
            ->andFilterWhere(['like', 'tour_end_date', $this->tour_end_date])
            ->andFilterWhere(['like', 'cities', $this->cities])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'other_contact_info', $this->other_contact_info])
            ->andFilterWhere(['like', 'original_inquiry', $this->original_inquiry])
            ->andFilterWhere(['like', 'follow_up_record', $this->follow_up_record])
            ->andFilterWhere(['like', 'tour_schedule_note', $this->tour_schedule_note])
            ->andFilterWhere(['like', 'other_note', $this->other_note])
            ->andFilterWhere(['like', 'probability', $this->probability])
            ->andFilterWhere(['like', 'inquiry_status', $this->inquiry_status])
            ->andFilterWhere(['like', 'close_report', $this->close_report])
            ->andFilterWhere(['like', 'task_remind', $this->task_remind])
            ->andFilterWhere(['like', 'task_remind_date', $this->task_remind_date]);

        return $dataProvider;
    }
}
