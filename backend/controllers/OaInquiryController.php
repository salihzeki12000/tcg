<?php

namespace backend\controllers;

use Yii;
use common\models\OaInquiry;
use common\models\OaInquirySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * OaInquiryController implements the CRUD actions for OaInquiry model.
 */
class OaInquiryController extends Controller
{
    /**
     * @inheritdoc
     */
    public $canAdd = 0;
    public $canDel = 0;
    public $canMod = 1;
    public $isAdmin = 0;
    public $isAgent = 0;
    public $isAccountant= 0;
    public $isOperator = 0;
    public $canAddTour = 0;
    public $canAddPayment = 0;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        if (isset($roles['OA-Admin'])) {
            $this->isAdmin = 1;
            $this->canAdd = 1;
            $this->canDel = 1;
            $this->canAddTour = 1;
            $this->canAddPayment = 1;
        }
        if (isset($roles['OA-Agent'])) {
            $this->isAgent = 1;
            $this->canAdd = 1;
            $this->canAddPayment = 1;
        }
        if (isset($roles['OA-isOperator'])) {
            $this->isOperator = 1;
        }
        if (isset($roles['OA-Accountant'])) {
            $this->isAccountant = 1;
            $this->canAdd = 0;
            $this->canDel = 0;
            $this->canAddTour = 1;
            $this->canAddPayment = 1;
        }

        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['canAdd'] = $this->canAdd;
        $tmp['canDel'] = $this->canDel;
        $tmp['canMod'] = $this->canMod;
        $tmp['isAdmin'] = $this->isAdmin;
        $tmp['isAccountant'] = $this->isAccountant;
        $tmp['isOperator'] = $this->isOperator;
        $tmp['isAgent'] = $this->isAgent;
        $tmp['canAddTour'] = $this->canAddTour;
        $tmp['canAddPayment'] = $this->canAddPayment;
        $data['permission'] = $tmp;
        return parent::render($templateName, $data);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OaInquiry models.
     * @return mixed
     */
    public function actionIndex($user_id='', $co=0, $year='', $month='', $date_type=2, $inquiry_source='', $language='', $name_or_email='')
    {
        if (!($this->isAdmin || $this->isAccountant) && $user_id && $user_id!=Yii::$app->user->identity->id) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if (!isset($subAgent[$user_id])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action. ');
            }
        }

        $sql = "SELECT * FROM oa_inquiry WHERE agent IS NULL OR inquiry_source IS NULL OR inquiry_source='' OR `language` IS NULL OR `language`='' OR original_inquiry IS NULL OR original_inquiry='' ORDER BY id ";
        $inquiriesToAssign = Yii::$app->db->createCommand($sql)
        ->queryAll();
        foreach ($inquiriesToAssign as &$item) {
            unset($item['original_inquiry']);
            $item['same_email_ids'] = [];
            if (!empty($item['email'])) {
                $sql = "SELECT id FROM oa_inquiry WHERE email='{$item['email']}' AND id<{$item['id']} ";
                $sameEmailIds = Yii::$app->db->createCommand($sql)->queryAll();
                if (!empty($sameEmailIds)) {
                    foreach ($sameEmailIds as $emailItem) {
                        $item['same_email_ids'][] = $emailItem['id'];
                    }
                }
            }
            $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $item['agent']])->all(), 'id', 'username');
            if (array_key_exists($item['agent'], $agent)) {
                $item['agent'] = $agent[$item['agent']];
            }
            
            $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $item['creator']])->all(), 'id', 'username');
	        if (array_key_exists($item['creator'], $creator)) {
	            $item['creator'] = $creator[$item['creator']];
	        }
	        else{
	            $item['creator'] = 'Webform';
	        }
	                    
            $oa_inquiry_source = \common\models\Tools::getEnvironmentVariable('oa_inquiry_source');
            if (!empty($item['inquiry_source'])) {
                $item['inquiry_source'] = $oa_inquiry_source[$item['inquiry_source']];
            }
            
            $query = \common\models\OaTour::find()->where(['inquiry_id'=>$item['id']]);
            $tour = $query->one();
            if(!empty($tour))
            {
                $item['tour_id'] = $tour['id'];
            } 
        }

        $userList = $subAgent = [];
        $userId = Yii::$app->user->identity->id;
        $userName = Yii::$app->user->identity->username;
        if ($this->isAdmin || $this->isAccountant) {
            $subAgent = \common\models\Tools::getAgentUserList();
            if (isset($subAgent[$userId])) {
                unset($subAgent[$userId]);
                $userList = [$userId=>$userName];
            }
        }
        elseif($this->isAgent || $this->isOperator){
            $userList = [$userId=>$userName];
            $subAgent = \common\models\Tools::getSubUserByUserId($userId);
        }
        $userList = $userList + $subAgent;
        if ($this->isAdmin || $this->isAccountant) {
            $userList = [''=>'--All--'] + $userList;
        }
        //$user_id='', $co=0, $year='', $inquiry_source='', $language=''
        if (empty($user_id) && ($this->isAdmin || $this->isAccountant)) {
            $user_id = '';
        }
        elseif (!empty($user_id) && isset($userList[$user_id])) {
            $user_id = $user_id;
        }
        else {
            $user_id = $userId;
        }

		// define date range...
		$year = empty($year) ? date("Y") : $year;
    	if(!empty($month)):
        	$from_date = $year . '-' . $month . '-01';
			$end_date = $year . '-' . $month . '-31';
		else:
        	$from_date = $year . '-01-01';
			$end_date = ($year+1) . '-01-01';
		endif;
        
        //Total Inquiries | Bad | New + Following Up + Waiting for Payment | Inactive | Lost| Booked | Booking Rate (算式：Booked/(Booked+Lost+Inactive))                                      
        /*
            {
              "1": "New",
              "2": "Following up",
              "3": "Waiting for Payment",
              "4": "Inactive",
              "5": "Booked - Deposit Received",
              "6": "Booked - Full Payment Received",
              "7": "Booked - Other",
              "8": "Lost - Inactive until Tour Start Date",
              "9": "Lost - Booked with Someone Else",
              "10": "Lost - Low Budget",
              "11": "Lost - Trip Canceled",
              "12": "Lost - Other Reason",
              "13": "Bad - Wrong Contact Info",
              "14": "Bad - Duplicate"
            }
        */
        $statusArr = [
            // 'New + Following Up + Waiting for Payment' => ['1','2','3'], //New + Following Up + Waiting for Payment
            'Following' => ['1','2'], //New + Following Up + Waiting for Payment
            'Waiting for Payment' => ['3'],
            // 'Inactive' => ['4'], //Inactive
            'Booked' => ['5','6','7'], //Booked
            'Lost' => ['8','9','10','11','12','15'], //Lost
            'Bad' => ['13','14'], //Bad
        ];
        $summarySql = "SELECT * FROM oa_inquiry WHERE 1=1 ";
        
        if (!empty($user_id)) {
            if ($co==1) {
                $summarySql .= " AND  co_agent={$user_id} ";
            }
            else{
                $summarySql .= " AND  agent={$user_id} ";
            }
        }
        
        if (!empty($inquiry_source)) {
            $summarySql .= " AND  inquiry_source='{$inquiry_source}' ";
        }
        
        if (!empty($language)) {
            $summarySql .= " AND  language='{$language}' ";
        }
        
        if(!empty($name_or_email)):
            $summarySql .= " AND (contact LIKE '%{$name_or_email}%' OR email LIKE '%{$name_or_email}%' OR original_inquiry lIKE '%{$name_or_email}%') ";
        endif;
        
        if ($date_type == 2) {
            $summarySql .= " AND  create_time>='{$from_date}' ";

            if(!empty($month)):
            	$summarySql .= " AND  create_time<='{$end_date}' ";
            else:
            	$summarySql .= " AND  create_time<'{$end_date}' ";
            endif;
        }
        else{
            $summarySql .= " AND  tour_start_date>='{$from_date}' ";
            
            if(!empty($month)):
            	$summarySql .= " AND  tour_start_date<='{$end_date}' ";
            else:
            	$summarySql .= " AND  tour_start_date<'{$end_date}' ";
            endif;
        }
        
        $summarySql .= ' ORDER BY tour_start_date ASC ';

        $summaryAll = Yii::$app->db->createCommand($summarySql)
        ->queryAll();
        $totalCount = 0;
        $summaryInfo = [
            'Total Inquiries' => 0,
        ];
        $listInfo = [];
        foreach ($statusArr as $key => $value) {
            $listInfo[$key] = [];
            $summaryInfo[$key] = 0;
        }

        if ($summaryAll) {
            $totalCount = count($summaryAll);
            $summaryInfo['Total Inquiries'] = $totalCount;
            $oa_inquiry_status = \common\models\Tools::getEnvironmentVariable('oa_inquiry_status');
            foreach ($summaryAll as $sumitem) {
	            
                // unset($sumitem['original_inquiry']);
                if(!empty($sumitem['original_inquiry'])): $sumitem['original_inquiry'] == 1; endif;
                
                $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $sumitem['agent']])->all(), 'id', 'username');
                if (array_key_exists($sumitem['agent'], $agent)) {
                    $sumitem['agent'] = $agent[$sumitem['agent']];
                }
                $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $sumitem['co_agent']])->all(), 'id', 'username');
                if (array_key_exists($sumitem['co_agent'], $co_agent)) {
                    $sumitem['co_agent'] = $co_agent[$sumitem['co_agent']];
                }
                $sumitem['inquiry_status_txt'] = $oa_inquiry_status[$sumitem['inquiry_status']];

                foreach ($statusArr as $statkey => $statGroup) {
                    if (in_array($sumitem['inquiry_status'], $statGroup)) {
                        $summaryInfo[$statkey] ++;
                        $listInfo[$statkey][] = $sumitem;
                    }
                }

            }
        }
        $summaryInfo['Booking Rate'] = 0;
        // if (($sum = ($summaryInfo['Booked'] + $summaryInfo['Lost'] + $summaryInfo['Inactive'])) > 0 ) {
        if (($sum = ($summaryInfo['Booked'] + $summaryInfo['Lost'])) > 0 ) {
            $summaryInfo['Booking Rate'] = intval(($summaryInfo['Booked']/$sum)*100) . '%';
        }

        // var_dump($summaryInfo);exit;
        return $this->render('index', [
            'inquiriesToAssign' => $inquiriesToAssign,
            'summaryInfo' => $summaryInfo,
            'userList' => $userList,
            'listInfo' => $listInfo,
            'user_id' => $user_id,
            'co' => $co,
            'year' => $year,
            'month' => $month,
            'date_type' => $date_type,
            'inquiry_source' => $inquiry_source,
            'language' => $language,
            'name_or_email' => $name_or_email,
        ]);
    }

    /**
     * Displays a single OaInquiry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $userId = Yii::$app->user->identity->id;
        if (!($this->isAdmin || $this->isAccountant) && $model->agent!=$userId && $model->co_agent!=$userId) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if (!isset($subAgent[$model->agent]) && !isset($subAgent[$model->co_agent])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action. ');
            }
        }

        $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->creator])->all(), 'id', 'username');
        if (array_key_exists($model->creator, $creator)) {
            $model->creator = $creator[$model->creator];
        }
        else{
            $model->creator = 'Webform';
        }

        $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $model->cities)])->all(), 'id', 'name');
        $model->cities = join(',', array_values($cities));

        $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->agent])->all(), 'id', 'username');
        if (array_key_exists($model->agent, $agent)) {
            $model->agent = $agent[$model->agent];
        }

        $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->co_agent])->all(), 'id', 'username');
        if (array_key_exists($model->co_agent, $co_agent)) {
            $model->co_agent = $co_agent[$model->co_agent];
        }

		if(!empty($model->tour_type)):
        	$model->tour_type = Yii::$app->params['form_types'][$model->tour_type];
        else:
        	$model->tour_type = "(not set)";
        endif;

        $model->close = Yii::$app->params['yes_or_no'][$model->close];

        $oa_inquiry_status = \common\models\Tools::getEnvironmentVariable('oa_inquiry_status');
        if (!empty($model->inquiry_status)) {
            $model->inquiry_status = $oa_inquiry_status[$model->inquiry_status];
        }

        $oa_inquiry_source = \common\models\Tools::getEnvironmentVariable('oa_inquiry_source');
        if (!empty($model->inquiry_source)) {
            $model->inquiry_source = $oa_inquiry_source[$model->inquiry_source];
        }

        $oa_group_type = \common\models\Tools::getEnvironmentVariable('oa_group_type');
        if (!empty($model->group_type)) {
            $model->group_type = $oa_group_type[$model->group_type];
        }
            
        $query = \common\models\OaTour::find()->where(['inquiry_id'=>$model->id]);
        $tour = $query->one();
        if(!empty($tour)):
            $tour_id = $tour['id'];
        else:
            $tour_id = '';
        endif;
        
        $_GET['sort'] = 'id';
        $_GET['inquiry_id'] = $id;
        $searchModel = new \common\models\OaPaymentSearch();
        $queryParams = Yii::$app->request->queryParams;
        unset($queryParams['id']);
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->sort = false;

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tour_id' => $tour_id,
        ]);
    }

    /**
     * Creates a new OaInquiry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ($this->canAdd != 1) {
            throw new ForbiddenHttpException('You are not allowed to perform this action. ');
        }

        $model = new OaInquiry();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaInquiry']['cities']) && is_array($_POST['OaInquiry']['cities'])) {
                $model->cities = join(',', $_POST['OaInquiry']['cities']);
            }
            
            $model->create_time = date('Y-m-d H:i:s',time());
            $model->creator = Yii::$app->user->identity->id;
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->cities = explode(',', $model->cities);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaInquiry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if($model->close && !$this->isAdmin):
            throw new ForbiddenHttpException('This inquiry is closed. You are not allowed to perform this action.');
        endif;
        
        $userId = Yii::$app->user->identity->id;
        if (!$this->isAccountant && !$this->isAdmin && $model->agent!=$userId && $model->co_agent!=$userId) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if (!isset($subAgent[$model->agent]) && !isset($subAgent[$model->co_agent])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action. ');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_POST['OaInquiry']['cities']) && is_array($_POST['OaInquiry']['cities'])) {
                $model->cities = join(',', $_POST['OaInquiry']['cities']);
            }
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->cities = explode(',', $model->cities);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaInquiry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->close):
            throw new ForbiddenHttpException('This inquiry is closed. You are not allowed to perform this action.');
        endif;
	    
        if($this->canDel != 1) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OaInquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaInquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaInquiry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
