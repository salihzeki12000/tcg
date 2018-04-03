<?php

namespace common\models;

use Yii;
use yii\base\Model;
//use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use common\models\OaFeedback;

/**
 * OaFeedbackSearch represents the model behind the search form about `common\models\OaFeedback`.
 */
class OaFeedbackSearch extends OaFeedback
{
	public $username;
	public $tour_end_date;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tour_id'], 'integer'],
            [['username', 'tour_end_date'], 'string'],
            [['create_time', 'comment_itinerary', 'comment_meals', 'comment_service_agent', 'comment_service_guide_driver', 'why_chose_us', 'rate', 'suggestions'], 'safe'],
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
	    
	    $sql = "SELECT * FROM oa_feedback AS OA_FEEDBACK ";
        
        $sql .= "LEFT JOIN (SELECT id as tid, agent, tour_end_date FROM oa_tour GROUP BY id) AS OA_TOUR ON OA_TOUR.tid = OA_FEEDBACK.tour_id ";      
        
        $sql .= "LEFT JOIN (SELECT id as aid, username FROM user GROUP BY id) AS USER ON OA_TOUR.agent = USER.aid ";

		$sql .= "WHERE 1=1 ";

		if(!empty($this->id)):
        	$sql .= "AND OA_FEEDBACK.id = '$this->id' ";
		endif;
		
		if(!empty($this->tour_id)):
        	$sql .= "AND OA_FEEDBACK.tour_id = '$this->tour_id' ";
		endif;
		
		if(!empty($this->username)):
        	$sql .= "AND USER.username LIKE '%{$this->username}%' ";
		endif;
		
		if(!empty($this->tour_end_date)):
        	$sql .= "AND OA_TOUR.tour_end_date LIKE '%{$this->tour_end_date}%' ";
		endif;
		
		if(!empty($this->create_time)):
        	$sql .= "AND OA_FEEDBACK.create_time LIKE '%{$this->create_time}%' ";
		endif;
		
		if(!empty($this->rate)):
        	$sql .= "AND OA_FEEDBACK.rate = '$this->rate' ";
		endif;

		$count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ($sql) as FEEDBACKS")->queryScalar();
		
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
