<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FormCard;

/**
 * FormCardSearch represents the model behind the search form about `common\models\FormCard`.
 */
class FormCardSearch extends FormCard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'card_security_code'], 'integer'],
            [['card_type', 'client_name', 'name_on_card', 'expiry_month', 'expiry_year', 'billing_address', 'contact_phone', 'email', 'card_holder_email', 'travel_agent', 'tour_date', 'create_time'], 'safe'],
            [['card_number', 'amount_to_bill'], 'number'],
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
        $query = FormCard::find();

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
            'card_number' => $this->card_number,
            'card_security_code' => $this->card_security_code,
            'amount_to_bill' => $this->amount_to_bill,
            'create_time' => $this->create_time,
        ]);

        $query->andFilterWhere(['like', 'card_type', $this->card_type])
            ->andFilterWhere(['like', 'client_name', $this->client_name])
            ->andFilterWhere(['like', 'name_on_card', $this->name_on_card])
            ->andFilterWhere(['like', 'expiry_month', $this->expiry_month])
            ->andFilterWhere(['like', 'expiry_year', $this->expiry_year])
            ->andFilterWhere(['like', 'billing_address', $this->billing_address])
            ->andFilterWhere(['like', 'contact_phone', $this->contact_phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'card_holder_email', $this->card_holder_email])
            ->andFilterWhere(['like', 'travel_agent', $this->travel_agent])
            ->andFilterWhere(['like', 'tour_date', $this->tour_date]);

        return $dataProvider;
    }
}
