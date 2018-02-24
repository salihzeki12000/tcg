<?php

namespace common\models;

use Yii;
use yii\base\Model;
//use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use common\models\OaPayment;

/**
 * OaPaymentSearch represents the model behind the search form about `common\models\OaPayment`.
 */
class OaPaymentSearch extends OaPayment
{
	public $tour_start_date;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id', 'inquiry_id', 'payer_type'], 'integer'],
            [['create_time', 'update_time', 'payer', 'type', 'due_date', 'pay_method', 'status', 'receit_account', 'receit_date', 'cc_note_signing', 'note'], 'safe'],
            ['tour_start_date', 'string'],
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
	    $this->load($params);
	    
	    if(isset($params['tour_id'])):
            $this->tour_id = $params['tour_id'];
        endif;
	    
	    if(isset($params['inquiry_id'])):
            $this->inquiry_id = $params['inquiry_id'];
        endif;

	    if(!empty($this->tour_start_date)):
            $dates = explode(' to ', $this->tour_start_date);
        endif;
	    		
	    $sql = "SELECT * FROM oa_payment AS OA_PAYMENT ";
        
        $sql .= "LEFT JOIN (SELECT id as tid, tour_start_date FROM oa_tour GROUP BY id) AS OA_TOUR ON OA_TOUR.tid = OA_PAYMENT.tour_id ";      

		$sql .= "WHERE 1=1 ";

		if(!empty($this->id)):
        	$sql .= "AND OA_PAYMENT.id = '$this->id' ";
		endif;
		
		if(!empty($this->tour_id)):
        	$sql .= "AND OA_PAYMENT.tour_id = '$this->tour_id' ";
		endif;
		
		if(!empty($this->inquiry_id)):
        	$sql .= "AND OA_PAYMENT.inquiry_id = '$this->inquiry_id' ";
		endif;

		if(!empty($this->create_time)):
        	$sql .= "AND OA_PAYMENT.create_time = '$this->create_time' ";
		endif;

		if(!empty($this->update_time)):
        	$sql .= "AND OA_PAYMENT.update_time = '$this->update_time' ";
		endif;

		if(!empty($this->cny_amount)):
        	$sql .= "AND OA_PAYMENT.cny_amount = '$this->cny_amount' ";
		endif;

		if(!empty($this->receit_cny_amount)):
        	$sql .= "AND OA_PAYMENT.receit_cny_amount = '$this->receit_cny_amount' ";
		endif;

		if(!empty($this->transaction_fee)):
        	$sql .= "AND OA_PAYMENT.transaction_fee = '$this->transaction_fee' ";
		endif;
		
		if(!empty($this->payer)):
        	$sql .= "AND OA_PAYMENT.payer LIKE '%$this->payer%' ";
		endif;
		
		if(!empty($this->payer_type)):
        	$sql .= "AND OA_PAYMENT.payer_type = '$this->payer_type' ";
		endif;

		if(!empty($this->type)):
			$sql .= "AND OA_PAYMENT.type LIKE '%$this->type%' ";
		endif;

		if(!empty($this->due_date)):
			$sql .= "AND OA_PAYMENT.due_date LIKE '%$this->due_date%' ";
		endif;

		if(!empty($this->pay_method)):
			$sql .= "AND OA_PAYMENT.pay_method = '$this->pay_method' ";
		endif;

		if($this->status != ''):
			$sql .= "AND OA_PAYMENT.status = $this->status ";
		endif;

		if(!empty($this->receit_account)):
			$sql .= "AND OA_PAYMENT.receit_account LIKE '%$this->receit_account%' ";
		endif;

		if(!empty($this->receit_date)):
			$sql .= "AND OA_PAYMENT.receit_date LIKE '%$this->receit_date%' ";
		endif;

		if(!empty($this->cc_note_signing)):
			$sql .= "AND OA_PAYMENT.cc_note_signing LIKE '%$this->cc_note_signing%' ";
		endif;

		if(!empty($this->note)):
			$sql .= "AND OA_PAYMENT.note LIKE '%$this->note%' ";
		endif;

		if(!empty($dates)):
			if(\common\models\Tools::validateDate($dates[0])):
				if(!empty($dates[1]) && \common\models\Tools::validateDate($dates[1])):
					if($dates[0] == $dates[1]):
						$sql .= "AND tour_start_date = '$dates[0]' ";
					else:
						$sql .= "AND tour_start_date >= '$dates[0]' AND tour_start_date <= '$dates[1]' ";
					endif;
				else:
					$sql .= "AND tour_start_date >= '$dates[0]' ";
				endif;
			endif;
		endif;

		$count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ($sql) as PAYMENTS")->queryScalar();
		
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
