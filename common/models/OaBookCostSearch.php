<?php

namespace common\models;

use Yii;
use yii\base\Model;
// use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
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
            [['id', 'tour_id', 'creator', 'type', 'need_to_pay', 'pay_status'], 'integer'],
            [['transaction_fee'], 'number'],
            [['create_time', 'updat_time', 'start_date', 'end_date', 'cl_info', 'due_date_for_pay', 'pay_date', 'transaction_note', 'book_status', 'book_date', 'note', 'pay_method'], 'safe'],
            ['fid', 'string'],
            [['cny_amount', 'pay_amount', 'confirmed_amount'], 'number'],
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
    /* public function search($params)
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

        if (isset($params['tour_id'])) {
            $this->tour_id = $params['tour_id'];
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'create_time' => $this->create_time,
            'updat_time' => $this->updat_time,
            'creator' => $this->creator,
            'type' => $this->type,
            'fid' => $this->fid,
            'need_to_pay' => $this->need_to_pay,
            'cny_amount' => $this->cny_amount,
            'pay_status' => $this->pay_status,
            'confirmed_amount' => $this->confirmed_amount,
            'pay_amount' => $this->pay_amount,
        ]);

        $query->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date])
            ->andFilterWhere(['like', 'cl_info', $this->cl_info])
            ->andFilterWhere(['like', 'due_date_for_pay', $this->due_date_for_pay])
            ->andFilterWhere(['like', 'pay_date', $this->pay_date])
            ->andFilterWhere(['pay_method' => $this->pay_method])
            ->andFilterWhere(['like', 'transaction_fee', $this->transaction_fee])
            ->andFilterWhere(['like', 'transaction_note', $this->transaction_note])
            ->andFilterWhere(['like', 'book_status', $this->book_status])
            ->andFilterWhere(['like', 'book_date', $this->book_date])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    } */
    
    public function search($params)
    {
	    $this->load($params);

        if(isset($params['tour_id'])) {
            $this->tour_id = $params['tour_id'];
        }
        
        $sql = "SELECT * FROM oa_book_cost AS OA_BOOK_COST ";

		$sql .= "WHERE 1=1 ";
		
		if(!empty($this->fid)):
        	$sql .= "AND ((OA_BOOK_COST.type = ".OA_BOOK_COST_TYPE_AGENCY." AND OA_BOOK_COST.fid IN (SELECT id FROM oa_agency WHERE name LIKE '%$this->fid%')) ";
        	$sql .= "OR (OA_BOOK_COST.type = ".OA_BOOK_COST_TYPE_GUIDE." AND OA_BOOK_COST.fid IN (SELECT id FROM oa_guide WHERE name LIKE '%$this->fid%')) ";
        	$sql .= "OR (OA_BOOK_COST.type = ".OA_BOOK_COST_TYPE_HOTEL." AND OA_BOOK_COST.fid IN (SELECT id FROM oa_hotel WHERE name LIKE '%$this->fid%')) ";
        	$sql .= "OR (OA_BOOK_COST.type = ".OA_BOOK_COST_TYPE_OTHER." AND OA_BOOK_COST.fid IN (SELECT id FROM oa_other_cost WHERE name LIKE '%$this->fid%'))) ";
		endif;

		if(!empty($this->id)):
        	$sql .= "AND OA_BOOK_COST.id = '$this->id' ";
		endif;

		if(!empty($this->tour_id)):
        	$sql .= "AND OA_BOOK_COST.tour_id = '$this->tour_id' ";
		endif;

		if(!empty($this->create_time)):
        	$sql .= "AND OA_BOOK_COST.create_time = '$this->create_time' ";
		endif;

		if(!empty($this->updat_time)):
        	$sql .= "AND OA_BOOK_COST.updat_time = '$this->updat_time' ";
		endif;

		if(!empty($this->creator)):
        	$sql .= "AND OA_BOOK_COST.creator = '$this->creator' ";
		endif;

		if(!empty($this->type)):
        	$sql .= "AND OA_BOOK_COST.type = '$this->type' ";
		endif;

		if($this->need_to_pay != ''):
        	$sql .= "AND OA_BOOK_COST.need_to_pay = '$this->need_to_pay' ";
		endif;

		if(!empty($this->cny_amount)):
        	$sql .= "AND OA_BOOK_COST.cny_amount = '$this->cny_amount' ";
		endif;

		if($this->pay_status != ''):
        	$sql .= "AND OA_BOOK_COST.pay_status = '$this->pay_status' ";
		endif;

		if(!empty($this->confirmed_amount)):
        	$sql .= "AND OA_BOOK_COST.confirmed_amount = '$this->confirmed_amount' ";
		endif;

		if(!empty($this->pay_amount)):
        	$sql .= "AND OA_BOOK_COST.pay_amount = '$this->pay_amount' ";
		endif;

		if(!empty($this->pay_method)):
        	$sql .= "AND OA_BOOK_COST.pay_method = '$this->pay_method' ";
		endif;
		
		if(!empty($this->start_date)):
        	$sql .= "AND OA_BOOK_COST.start_date LIKE '%$this->start_date%' ";
		endif;
		
		if(!empty($this->end_date)):
        	$sql .= "AND OA_BOOK_COST.end_date LIKE '%$this->end_date%' ";
		endif;
		
		if(!empty($this->cl_info)):
        	$sql .= "AND OA_BOOK_COST.cl_info LIKE '%$this->cl_info%' ";
		endif;
		
		if(!empty($this->due_date_for_pay)):
        	$sql .= "AND OA_BOOK_COST.due_date_for_pay LIKE '%$this->due_date_for_pay%' ";
		endif;
		
		if(!empty($this->pay_date)):
        	$sql .= "AND OA_BOOK_COST.pay_date LIKE '%$this->pay_date%' ";
		endif;
		
		if(!empty($this->transaction_fee)):
        	$sql .= "AND OA_BOOK_COST.transaction_fee LIKE '%$this->transaction_fee%' ";
		endif;
		
		if(!empty($this->transaction_note)):
        	$sql .= "AND OA_BOOK_COST.transaction_note LIKE '%$this->transaction_note%' ";
		endif;
		
		if(!empty($this->book_status)):
        	$sql .= "AND OA_BOOK_COST.book_status LIKE '%$this->book_status%' ";
		endif;
		
		if(!empty($this->book_date)):
        	$sql .= "AND OA_BOOK_COST.book_date LIKE '%$this->book_date%' ";
		endif;
		
		if(!empty($this->note)):
        	$sql .= "AND OA_BOOK_COST.note LIKE '%$this->note%' ";
		endif;

		$count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ($sql) as COSTS")->queryScalar();

		$dataProvider = new SqlDataProvider([
	       'sql' => $sql,
		   'totalCount' => $count,
	       'pagination' => [
	         'pageSize' => 100
	        ],
	     ]);
		
		return $dataProvider;
    }
}