<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OaDailyCost;

/**
 * OaDailyCostSearch represents the model behind the search form about `common\models\OaDailyCost`.
 */
class OaDailyCostSearch extends OaDailyCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator', 'type', 'sub_type', 'amount', 'pay_status'], 'integer'],
            [['create_time', 'pay_date', 'notes'], 'safe'],
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
        $query = OaDailyCost::find();

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
            'creator' => $this->creator,
            'type' => $this->type,
            'sub_type' => $this->sub_type,
            'amount' => $this->amount,
            'pay_status' => $this->pay_status,
        ]);

        $query->andFilterWhere(['like', 'pay_date', $this->pay_date])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}