<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FormInfo;

/**
 * FormInfoSearch represents the model behind the search form about `common\models\FormInfo`.
 */
class FormInfoSearch extends FormInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['arrival_date', 'arrival_city', 'departure_date', 'departure_city', 'adults', 'children', 'infants', 'guest_information', 'group_type', 'cities_plan', 'travel_interests', 'prefered_budget', 'additional_information', 'name_prefix', 'name', 'email', 'nationality', 'prefered_travel_agent', 'tour_code', 'tour_name', 'book_hotels', 'hotel_preferences', 'room_requirements', 'subject_program', 'participants_number', 'ideas', 'school_name', 'position', 'phone_number', 'hear_about_us', 'purpose_trip', 'number_participants', 'ideas_trip', 'company_name', 'create_time'], 'safe'],
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
        $query = FormInfo::find();

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
            'type' => $this->type,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['>=', 'status', '0'])
            ->andFilterWhere(['like', 'arrival_date', $this->arrival_date])
            ->andFilterWhere(['like', 'arrival_city', $this->arrival_city])
            ->andFilterWhere(['like', 'departure_date', $this->departure_date])
            ->andFilterWhere(['like', 'departure_city', $this->departure_city])
            ->andFilterWhere(['like', 'adults', $this->adults])
            ->andFilterWhere(['like', 'children', $this->children])
            ->andFilterWhere(['like', 'infants', $this->infants])
            ->andFilterWhere(['like', 'guest_information', $this->guest_information])
            ->andFilterWhere(['like', 'group_type', $this->group_type])
            ->andFilterWhere(['like', 'cities_plan', $this->cities_plan])
            ->andFilterWhere(['like', 'travel_interests', $this->travel_interests])
            ->andFilterWhere(['like', 'prefered_budget', $this->prefered_budget])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'name_prefix', $this->name_prefix])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'prefered_travel_agent', $this->prefered_travel_agent])
            ->andFilterWhere(['like', 'tour_code', $this->tour_code])
            ->andFilterWhere(['like', 'tour_name', $this->tour_name])
            ->andFilterWhere(['like', 'book_hotels', $this->book_hotels])
            ->andFilterWhere(['like', 'hotel_preferences', $this->hotel_preferences])
            ->andFilterWhere(['like', 'room_requirements', $this->room_requirements])
            ->andFilterWhere(['like', 'subject_program', $this->subject_program])
            ->andFilterWhere(['like', 'participants_number', $this->participants_number])
            ->andFilterWhere(['like', 'ideas', $this->ideas])
            ->andFilterWhere(['like', 'school_name', $this->school_name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'hear_about_us', $this->hear_about_us])
            ->andFilterWhere(['like', 'purpose_trip', $this->purpose_trip])
            ->andFilterWhere(['like', 'number_participants', $this->number_participants])
            ->andFilterWhere(['like', 'ideas_trip', $this->ideas_trip])
            ->andFilterWhere(['like', 'company_name', $this->company_name]);

        return $dataProvider;
    }
}
