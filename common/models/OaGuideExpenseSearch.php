<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaGuideExpense;

/**
 * OaGuideExpenseSearch represents the model behind the search form about `common\models\OaGuideExpense`.
 */
class OaGuideExpenseSearch extends OaGuideExpense
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'guide_id'], 'integer'],
            [['start_date', 'end_date', 'details_spendings', 'cash_collect', 'notes'], 'safe'],
            [['guide_service_fee', 'amount_spendings'], 'number'],
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
        $query = OaGuideExpense::find();

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
            'guide_id' => $this->guide_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'guide_service_fee' => $this->guide_service_fee,
            'amount_spendings' => $this->amount_spendings,
        ]);

        $query->andFilterWhere(['like', 'details_spendings', $this->details_spendings])
            ->andFilterWhere(['like', 'cash_collect', $this->cash_collect])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
