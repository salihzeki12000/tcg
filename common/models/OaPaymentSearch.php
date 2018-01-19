<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaPayment;

/**
 * OaPaymentSearch represents the model behind the search form about `common\models\OaPayment`.
 */
class OaPaymentSearch extends OaPayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id'], 'integer'],
            [['create_time', 'update_time', 'payer', 'type', 'due_date', 'pay_method', 'status', 'receit_account', 'receit_date', 'cc_note_signing', 'note'], 'safe'],
            [['cny_amount', 'receit_cny_amount', 'transaction_fee'], 'number'],
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
        $query = OaPayment::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (isset($params['tour_id'])) {
            $this->tour_id = $params['tour_id'];
        }
		
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'cny_amount' => $this->cny_amount,
            'receit_cny_amount' => $this->receit_cny_amount,
            'transaction_fee' => $this->transaction_fee,
        ]);

        $query->andFilterWhere(['like', 'payer', $this->payer])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'due_date', $this->due_date])
            ->andFilterWhere(['like', 'pay_method', $this->pay_method])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'receit_account', $this->receit_account])
            ->andFilterWhere(['like', 'receit_date', $this->receit_date])
            ->andFilterWhere(['like', 'cc_note_signing', $this->cc_note_signing])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
