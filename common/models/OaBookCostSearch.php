<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaBookCost;

/**
 * OaBookCostSearch represents the model behind the search form about `common\models\OaBookCost`.
 */
class OaBookCostSearch extends OaBookCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'creator', 'type', 'fid', 'need_to_pay', 'pay_status'], 'integer'],
            [['create_time', 'updat_time', 'start_date', 'end_date', 'cl_info', 'due_date_for_pay', 'pay_date', 'transaction_note', 'book_status', 'note'], 'safe'],
            [['cny_amount', 'pay_amount'], 'number'],
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
        $query = OaBookCost::find();

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
            'tour_id' => $params['tour_id'],
            'create_time' => $this->create_time,
            'updat_time' => $this->updat_time,
            'creator' => $this->creator,
            'type' => $this->type,
            'fid' => $this->fid,
            'need_to_pay' => $this->need_to_pay,
            'cny_amount' => $this->cny_amount,
            'pay_status' => $this->pay_status,
            'pay_amount' => $this->pay_amount,
        ]);

        $query->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date])
            ->andFilterWhere(['like', 'cl_info', $this->cl_info])
            ->andFilterWhere(['like', 'due_date_for_pay', $this->due_date_for_pay])
            ->andFilterWhere(['like', 'pay_date', $this->pay_date])
            ->andFilterWhere(['like', 'transaction_note', $this->transaction_note])
            ->andFilterWhere(['like', 'book_status', $this->book_status])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
