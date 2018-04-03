<?php

namespace backend\controllers;

use Yii;
use common\models\OaTour;
use common\models\OaTourSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OaTourController implements the CRUD actions for OaTour model.
 */
class OaTourController extends Controller
{
    public $isAdmin = 0;
    public $canAdd = 0;
    public $canDel = 0;
    public $canMod = 1;
    public $isAgent = 0;
    public $isOperator = 0;
    public $isAccountant = 0;
    public $canAddPayment = 0;
    public $canAddBookCost = 0;
    public $arrUserType = [1=>'As Agent', 2=>'As Co Agent', 3=>'As Operator'];
    public $arrDateType = [1=>'Tour End Date', 2=>'Tour Create Date'];

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        if(isset($roles['OA-Admin'])) {
            $this->isAdmin = 1;
            $this->canAdd = 1;
            $this->canDel = 1;
            $this->canAddPayment = 1;
            $this->canAddBookCost = 1;
        }
        if(isset($roles['OA-Agent'])) {
            // $this->canAdd = 1;
            $this->isAgent = 1;
            $this->canAddPayment = 1;
            $this->canAddBookCost = 1;
        }
        if(isset($roles['OA-Operator'])) {
            $this->canAddBookCost = 1;
            $this->isOperator = 1;
        }
        if(isset($roles['OA-Accountant'])) {
            $this->isAccountant = 1;
            $this->canAdd = 1;
            $this->canDel = 1;
            $this->canAddPayment = 1;
            $this->canAddBookCost = 1;
        }

        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['canAdd'] = $this->canAdd;
        $tmp['canDel'] = $this->canDel;
        $tmp['canMod'] = $this->canMod;
        $tmp['canAddPayment'] = $this->canAddPayment;
        $tmp['canAddBookCost'] = $this->canAddBookCost;
        $tmp['isAgent'] = $this->isAgent;
        $tmp['isOperator'] = $this->isOperator;
        $tmp['isAdmin'] = $this->isAdmin;
        $tmp['isAccountant'] = $this->isAccountant;
        $data['permission'] = $tmp;
        $data['arrUserType'] = $this->arrUserType;
        $data['arrDateType'] = $this->arrDateType;
        return parent::render($templateName, $data);
    }
    
    
    /**
     * @inheritdoc
     */
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
     * Lists all OaTour models.
     * @return mixed
     */
    public function actionIndex($user_id='', $user_type=1, $year='', $month='', $date_type=1, $inquiry_source='', $language='', $name_or_email='')
    {
        if(!($this->isAdmin || $this->isAccountant) && $user_id && $user_id!=Yii::$app->user->identity->id) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if(!isset($subAgent[$user_id])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action.');
            }
        }

        $userList = $subAgent = [];
        $userId = Yii::$app->user->identity->id;
        $userName = Yii::$app->user->identity->username;
        if($this->isAdmin || $this->isAccountant) {
            $subAgent = \common\models\Tools::getAgentUserList();
            if(isset($subAgent[$userId])) {
                unset($subAgent[$userId]);
                $userList = [$userId=>$userName];
            }
        }
        elseif($this->isAgent || $this->isOperator){
            $userList = [$userId=>$userName];
            $subAgent = \common\models\Tools::getSubUserByUserId($userId);
        }
        $userList = $userList + $subAgent;
        if($this->isAdmin || $this->isAccountant) {
            $userList = [''=>'--All--'] + $userList;
        }

        if(empty($user_id) && ($this->isAdmin || $this->isAccountant)) {
            $user_id = '';
        }
        elseif(!empty($user_id) && isset($userList[$user_id])) {
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
			$dateComparison = '<=';
		else:
        	$from_date = $year . '-01-01';
			$end_date = ($year+1) . '-01-01';
			$dateComparison = '<';
		endif;

        //Total Tours | Not Closed | Estimated Gross Profit (Not Closed) | Closed | Sales Amount (Closed) | Gross Profit(Closed)                                

        $statusArr = [
            'Not Closed' => ['close'=>0], //
            'Estimated Gross Profit (Not Closed)' => ['close'=>0, 'sum_field'=>'tour_price-estimated_cost'], //
            'Closed' => ['close'=>1], //
            'Sales Amount (Closed)' => ['close'=>1, 'sum_field'=>'accounting_sales_amount'], //
            'Gross Profit (Closed)' => ['close'=>1, 'sum_field'=>'accounting_sales_amount-accounting_total_cost'], //
        ];
        
        $summarySql = "SELECT * FROM oa_tour AS OA_TOUR ";
        
        $summarySql .= "LEFT JOIN (SELECT tour_id, sum(cny_amount) AS total_payments, sum(confirmed_amount) as pay_confirmed_amount, sum(receit_cny_amount) as pay_accounting_amount FROM oa_payment GROUP BY tour_id) AS OA_PAYMENT ON OA_TOUR.id = OA_PAYMENT.tour_id ";
        
        $summarySql .= "LEFT JOIN (SELECT tour_id, sum(confirmed_amount) as cost_confirmed_amount, sum(pay_amount) as cost_accounting_amount FROM oa_book_cost GROUP BY tour_id) AS OA_BOOK_COST ON OA_TOUR.id = OA_BOOK_COST.tour_id ";
        
        $summarySql .= "LEFT JOIN (SELECT tour_id, 1 AS payment_overdue FROM oa_payment WHERE status = 0 AND CURRENT_DATE >= due_date GROUP BY tour_id) AS OA_PAYMENT_OVERDUE ON OA_TOUR.id = OA_PAYMENT_OVERDUE.tour_id ";
        
        $summarySql .= "LEFT JOIN (SELECT tour_id, 1 AS no_confirmed_payments FROM (select TOTAL_PAYMENTS.tour_id, total_payments, not_paid FROM (SELECT tour_id, count(*) AS total_payments FROM oa_payment GROUP BY tour_id) AS TOTAL_PAYMENTS LEFT JOIN (SELECT tour_id, count(*) AS not_paid FROM oa_payment WHERE status = 0 GROUP BY tour_id) AS PAYMENT_DUE ON TOTAL_PAYMENTS.tour_id = PAYMENT_DUE.tour_id GROUP BY TOTAL_PAYMENTS.tour_id) AS TEMP WHERE total_payments = not_paid) AS NO_PAYMENTS_CONFIRMED ON OA_TOUR.id = NO_PAYMENTS_CONFIRMED.tour_id ";
        
        $summarySql .= "WHERE 1=1 ";

        if(!empty($user_id)) {
            if($user_type==2) {
                $summarySql .= " AND find_in_set({$user_id},co_agent) <> 0 ";
            }
            elseif($user_type==3){
                $summarySql .= " AND OA_TOUR.operator={$user_id} ";
            }
            else{
                $summarySql .= " AND OA_TOUR.agent={$user_id} ";
            }
        }
        if(!empty($inquiry_source)) {
            $summarySql .= " AND OA_TOUR.inquiry_source='{$inquiry_source}' ";
        }
        if(!empty($language)) {
            $summarySql .= " AND OA_TOUR.language='{$language}' ";
        }
        
        if(!empty($name_or_email)):
            $summarySql .= " AND (contact LIKE '%{$name_or_email}%' OR email LIKE '%{$name_or_email}%') ";
        endif;
        
        if($date_type == 2) {
            $summarySql .= " AND OA_TOUR.create_time>='{$from_date}' ";
            $summarySql .= " AND OA_TOUR.create_time{$dateComparison}'{$end_date}' ";
        }
        else{
            $summarySql .= " AND OA_TOUR.tour_end_date>='{$from_date}' ";
            $summarySql .= " AND OA_TOUR.tour_end_date{$dateComparison}'{$end_date}' ";
        } 

        $summaryAll = Yii::$app->db->createCommand($summarySql)
        ->queryAll();
        
        //$sql = 'SELECT tour_id FROM oa_payment AS OA_PAYMENT WHERE status = 0 AND DATEDIFF(due_date, CURRENT_DATE) <= 3 GROUP BY tour_id';
        //$result = Yii::$app->db->createCommand($sql)->queryAll();
        //var_dump($result); exit;

        $currentDateTime = strtotime(date('Y-m-d'));
        $totalCount = 0;
        $summaryInfo = [
            'Total Tours' => 0,
        ];
        $listInfo = ['On Tour'=>[], 'Pre-Tour'=>[], 'After Tour'=>[], 'Closed Tours'=>[]];
        foreach ($statusArr as $key => $value) {
            $summaryInfo[$key] = 0;
        }

        if($summaryAll) {
            $totalCount = count($summaryAll);
            $summaryInfo['Total Tours'] = $totalCount;
            foreach ($summaryAll as $sumitem) {
                $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $sumitem['agent']])->all(), 'id', 'username');
                if(array_key_exists($sumitem['agent'], $agent)) {
                    $sumitem['agent'] = $agent[$sumitem['agent']];
                }
                
		        $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => explode(',', $sumitem['co_agent'])])->all(), 'id', 'username');
		        $sumitem['co_agent'] = join(', ', array_values($co_agent));
                
                $operator = ArrayHelper::map(\common\models\User::find()->where(['id' => $sumitem['operator']])->all(), 'id', 'username');
                if(array_key_exists($sumitem['operator'], $operator)) {
                    $sumitem['operator'] = $operator[$sumitem['operator']];
                }
                $sumitem['close_txt'] = Yii::$app->params['yes_or_no'][$sumitem['close']];
                $sumitem['vip'] = Yii::$app->params['yes_or_no'][$sumitem['vip']];

                $oa_tour_stage = \common\models\Tools::getEnvironmentVariable('oa_tour_stage');
                if($sumitem['stage']) {
                    $sumitem['stage'] = $oa_tour_stage[$sumitem['stage']];
                }

                $intTourStartDate = strtotime($sumitem['tour_start_date']);
                $intTourEndDate = strtotime($sumitem['tour_end_date']);
                $sumitem['td_tour_start_date'] = abs($currentDateTime - $intTourStartDate);
                $sumitem['td_tour_end_date'] = abs($currentDateTime - $intTourEndDate);
                foreach ($listInfo as $listTitle => $listItems) {
                    if($listTitle == 'On Tour' && $sumitem['close'] == 0) {
                        if(($intTourStartDate-$currentDateTime) <= 3600*24*(15+1) && ($currentDateTime-$intTourEndDate) <= 3600*24*3) {
                            $listInfo['On Tour'][] = $sumitem;
                        }
                    }
                    elseif($listTitle == 'Pre-Tour' && $sumitem['close'] == 0) {
                        if(($intTourStartDate-$currentDateTime) > 3600*24*(15+1)) {
                            $listInfo['Pre-Tour'][] = $sumitem;
                        }
                    }
                    elseif($listTitle == 'After Tour' && $sumitem['close'] == 0) {
                        if(($currentDateTime-$intTourEndDate) > 3600*24*3) {
                            $listInfo['After Tour'][] = $sumitem;
                        }
                    }
                    elseif($listTitle == 'Closed Tours' && $sumitem['close'] == 1) {
/*
"1. Gross Profit = Accounting Sales Amount - Accounting Total Cost；
2. Gross Rate = Gross Profit / (Accounting Sales Amount - Accounting Hotel, Flight & Train Cost)；
3. General Gross Rate = Gross Profit / Accounting Sales Amount；"                                        
*/
                        $sumitem['gross_profit'] = $sumitem['accounting_sales_amount']-$sumitem['accounting_total_cost'];
                        $tmpDividend = $sumitem['accounting_sales_amount']-$sumitem['accounting_hotel_flight_train_cost'];
                        if($tmpDividend != 0) {
                            $sumitem['gross_rate'] = intval(($sumitem['gross_profit']/$tmpDividend)*100) . '%';
                        }
                        else{
                            $sumitem['gross_rate'] = '0%';
                        }
                        if($sumitem['accounting_sales_amount'] != 0) {
                            $sumitem['general_gross_rate'] = intval($sumitem['gross_profit']/$sumitem['accounting_sales_amount']*100) . '%';
                        }
                        else{
                            $sumitem['general_gross_rate'] = '0%';
                        }
                        $listInfo['Closed Tours'][] = $sumitem;

                    }
                }

                foreach ($statusArr as $statkey => $statGroup) {
                    if($sumitem['close'] == $statGroup['close']) {
                        if(!isset($statGroup['sum_field'])) {
                            $summaryInfo[$statkey] ++;
                        }
                        else{
                            if($statGroup['sum_field'] == 'tour_price-estimated_cost') {
                                $summaryInfo[$statkey] += ($sumitem['tour_price'] - $sumitem['estimated_cost']);
                            }
                            elseif($statGroup['sum_field'] == 'accounting_sales_amount') {
                                $summaryInfo[$statkey] += $sumitem['accounting_sales_amount'];
                            }
                            elseif($statGroup['sum_field'] == 'accounting_sales_amount-accounting_total_cost') {
                                $summaryInfo[$statkey] += ($sumitem['accounting_sales_amount']-$sumitem['accounting_total_cost']);
                            }
                        }
                    }
                }

            }
        }

        $sort = array_column($listInfo['On Tour'], 'td_tour_start_date');      
        array_multisort($sort, SORT_ASC, $listInfo['On Tour']);  

        $sort = array_column($listInfo['Pre-Tour'], 'td_tour_start_date');      
        array_multisort($sort, SORT_ASC, $listInfo['Pre-Tour']);  

        $sort = array_column($listInfo['After Tour'], 'td_tour_end_date');      
        array_multisort($sort, SORT_DESC, $listInfo['After Tour']);  

        $sort = array_column($listInfo['Closed Tours'], 'td_tour_end_date');      
        array_multisort($sort, SORT_DESC, $listInfo['Closed Tours']);  

    // echo json_encode($listInfo);exit;

        return $this->render('index', [
            'summaryInfo' => $summaryInfo,
            'userList' => $userList,
            'listInfo' => $listInfo,
            'user_id' => $user_id,
            'user_type' => $user_type,
            'year' => $year,
            'month' => $month,
            'date_type' => $date_type,
            'inquiry_source' => $inquiry_source,
            'language' => $language,
            'name_or_email' => $name_or_email,
        ]);
    }

    /**
     * Displays a single OaTour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $userId = Yii::$app->user->identity->id;
        
        if(!($this->isAdmin || $this->isAccountant) && $model->agent!=$userId && !$this->isCoAgent($userId, $model->co_agent) && $model->operator!=$userId) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if(!isset($subAgent[$model->agent]) && !isset($subAgent[$model->co_agent]) && !isset($subAgent[$model->operator])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action. ');
            }
        }

        $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $model->cities)])->all(), 'id', 'name');
        $model->cities = join(',', array_values($cities));

        $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->creator])->all(), 'id', 'username');
        if(array_key_exists($model->creator, $creator)) {
            $model->creator = $creator[$model->creator];
        }
        else{
            $model->creator = 'Webform';
        }

        $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->agent])->all(), 'id', 'username');
        if(array_key_exists($model->agent, $agent)) {
            $model->agent = $agent[$model->agent];
        }

        $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => explode(',', $model->co_agent)])->all(), 'id', 'username');
        $model->co_agent = join(', ', array_values($co_agent));

        $operator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->operator])->all(), 'id', 'username');
        if(array_key_exists($model->operator, $operator)) {
            $model->operator = $operator[$model->operator];
        }

        $oa_inquiry_source = \common\models\Tools::getEnvironmentVariable('oa_inquiry_source');
        if(!empty($model->inquiry_source)) {
            $model->inquiry_source = $oa_inquiry_source[$model->inquiry_source];
        }

        $oa_group_type = \common\models\Tools::getEnvironmentVariable('oa_group_type');
        if(!empty($model->group_type)) {
            $model->group_type = $oa_group_type[$model->group_type];
        }

        $oa_tour_stage = \common\models\Tools::getEnvironmentVariable('oa_tour_stage');
        if(!empty($model->stage)) {
            $model->stage = $oa_tour_stage[$model->stage];
        }
		
		if(!empty($model->tour_type)):
        	$model->tour_type = Yii::$app->params['form_types'][$model->tour_type];
        else:
        	$model->tour_type = "(not set)";
        endif;

        $model->vip = Yii::$app->params['yes_or_no'][$model->vip];

        $model->close = Yii::$app->params['yes_or_no'][$model->close];

        $_GET['sort'] = 'id';
        $_GET['tour_id'] = $id;
        $searchModel = new \common\models\OaPaymentSearch();
        $queryParams = Yii::$app->request->queryParams;
        unset($queryParams['id']);
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->sort = false;

        $searchModelBC = new \common\models\OaBookCostSearch();
        $queryParamsBC = Yii::$app->request->queryParams;
        unset($queryParamsBC['id']);
        $dataProviderBC = $searchModelBC->search($queryParamsBC);
        $dataProviderBC->sort = false;

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelBC' => $searchModelBC,
            'dataProviderBC' => $dataProviderBC,
        ]);
    }

    /**
     * Creates a new OaTour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($inquiry_id=null)
    {
        if($this->canAdd != 1) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $model = new OaTour();

        if($model->load(Yii::$app->request->post())) {
            if(isset($_POST['OaTour']['cities']) && is_array($_POST['OaTour']['cities'])) {
                $model->cities = join(',', $_POST['OaTour']['cities']);
            }
            
            if(isset($_POST['OaTour']['co_agent']) && is_array($_POST['OaTour']['co_agent'])) {
                $model->co_agent = join(',', $_POST['OaTour']['co_agent']);
            }
            
            if($model->inquiry_id) {
                if(($inquiryModel = \common\models\OaInquiry::findOne($model->inquiry_id)) === null) {
                    throw new NotFoundHttpException('Inquiry not found.');
                }
            }

            $model->create_time = date('Y-m-d H:i:s',time());
            $model->creator = Yii::$app->user->identity->id;

            if($model->save()) {
	            if($inquiryModel !== null):
	            	$payments = \common\models\OaPayment::find()->where(['inquiry_id' => $model->inquiry_id])->all();
	            	
	            	foreach($payments as $payment):
	            		$payment->tour_id = $model->id;
	            		$payment->save();
	            	endforeach;
	            endif;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(!empty($inquiry_id)) {
	            if(!\common\models\Tools::inquiryAssignedToTour($inquiry_id))
	            {
	                $model->inquiry_id = $inquiry_id;
	                if(($inquiryModel = \common\models\OaInquiry::findOne($model->inquiry_id)) !== null) {
	                    $model->inquiry_source = $inquiryModel->inquiry_source;
	                    $model->language = $inquiryModel->language;
	                    $model->agent = $inquiryModel->agent;
	                    
	                    if(!empty($inquiryModel->co_agent)) {
	                        $model->co_agent = explode(',', $inquiryModel->co_agent);
	                    }
	                    
	                    $model->tour_type = $inquiryModel->tour_type;
	                    $model->group_type = $inquiryModel->group_type;
	                    $model->country = $inquiryModel->country;
	                    $model->organization = $inquiryModel->organization;
	                    $model->number_of_travelers = $inquiryModel->number_of_travelers;
	                    $model->traveler_info = $inquiryModel->traveler_info;
	                    $model->tour_start_date = $inquiryModel->tour_start_date;
	                    $model->tour_end_date = $inquiryModel->tour_end_date;
	                    $model->contact = $inquiryModel->contact;
	                    $model->email = $inquiryModel->email;
	                    $model->other_contact_info = $inquiryModel->other_contact_info;
	                    $model->tour_schedule_note = $inquiryModel->tour_schedule_note;
	                    $model->other_note = $inquiryModel->other_note;
	                    $model->attachment = $inquiryModel->attachment;
	                    if(!empty($inquiryModel->cities)) {
	                        $model->cities = explode(',', $inquiryModel->cities);
	                    }
	                }
	                else{
	                    throw new NotFoundHttpException('Inquiry not found.');
	                }
	            }
	            else
	            {
		            throw new ForbiddenHttpException('Inquiry already assigned to tour. You are not allowed to perform this action.');
	            }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaTour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if($model->close && !$this->isAdmin):
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        endif;

        $userId = Yii::$app->user->identity->id;
        if(!($this->isAdmin || $this->isAccountant) && $model->agent!=$userId && !$this->isCoAgent($userId, $model->co_agent) && $model->operator!=$userId) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if(!isset($subAgent[$model->agent]) && !isset($subAgent[$model->co_agent]) && !isset($subAgent[$model->operator])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action.');
            }
        }

        if($model->load(Yii::$app->request->post())) {
            if(isset($_POST['OaTour']['cities']) && is_array($_POST['OaTour']['cities'])) {
                $model->cities = join(',', $_POST['OaTour']['cities']);
            }
            
            if(isset($_POST['OaTour']['co_agent']) && is_array($_POST['OaTour']['co_agent'])) {
                $model->co_agent = join(',', $_POST['OaTour']['co_agent']);
            }
            
            if($model->inquiry_id) {
                if(($inquiryModel = \common\models\OaInquiry::findOne($model->inquiry_id)) !== null) {
                }
                else{
                    throw new NotFoundHttpException('The inquiry does not found.');
                }
            }

            if($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->cities = explode(',', $model->cities);
            
            $model->co_agent = explode(',', $model->co_agent);

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaTour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->close):
            throw new ForbiddenHttpException('This tour is closed. You are not allowed to perform this action.');
        endif;
	    
        if($this->canDel != 1) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Displays a tour confirmation letter
     * @param integer $id
     * @return mixed
     */
    public function actionViewConfirmationLetter($id)
    {
        $model = $this->findModel($id);

        $userId = Yii::$app->user->identity->id;
        
        if(!($this->isAdmin || $this->isAccountant) && $model->agent!=$userId && !$this->isCoAgent($userId, $model->co_agent) && $model->operator!=$userId) {
            $subAgent = \common\models\Tools::getSubUserByUserId(Yii::$app->user->identity->id);
            if(!isset($subAgent[$model->agent]) && !isset($subAgent[$model->co_agent]) && !isset($subAgent[$model->operator])) {
                throw new ForbiddenHttpException('You are not allowed to perform this action. ');
            }
        }

        $cities = ArrayHelper::map(\common\models\OaCity::find()->where(['id' => explode(',', $model->cities)])->all(), 'id', 'name');
        $model->cities = join(',', array_values($cities));

        $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->creator])->all(), 'id', 'username');
        if(array_key_exists($model->creator, $creator)) {
            $model->creator = $creator[$model->creator];
        }
        else{
            $model->creator = 'Webform';
        }

        $agent = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->agent])->all(), 'id', 'username');
        if(array_key_exists($model->agent, $agent)) {
            $model->agent = $agent[$model->agent];
        }

        $co_agent = ArrayHelper::map(\common\models\User::find()->where(['id' => explode(',', $model->co_agent)])->all(), 'id', 'username');
        $model->co_agent = join(', ', array_values($co_agent));

        $operator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->operator])->all(), 'id', 'username');
        if(array_key_exists($model->operator, $operator)) {
            $model->operator = $operator[$model->operator];
        }

        $oa_inquiry_source = \common\models\Tools::getEnvironmentVariable('oa_inquiry_source');
        if(!empty($model->inquiry_source)) {
            $model->inquiry_source = $oa_inquiry_source[$model->inquiry_source];
        }

        $oa_group_type = \common\models\Tools::getEnvironmentVariable('oa_group_type');
        if(!empty($model->group_type)) {
            $model->group_type = $oa_group_type[$model->group_type];
        }

        $oa_tour_stage = \common\models\Tools::getEnvironmentVariable('oa_tour_stage');
        if(!empty($model->stage)) {
            $model->stage = $oa_tour_stage[$model->stage];
        }
		
		if(!empty($model->tour_type)):
        	$model->tour_type = Yii::$app->params['form_types'][$model->tour_type];
        else:
        	$model->tour_type = "(not set)";
        endif;

        $model->vip = Yii::$app->params['yes_or_no'][$model->vip];

        $model->close = Yii::$app->params['yes_or_no'][$model->close];

        $_GET['tour_id'] = $id;
        $searchModelBC = new \common\models\OaBookCostSearch();
        $queryParamsBC = Yii::$app->request->queryParams;
        unset($queryParamsBC['id']);
        $dataProviderBC = $searchModelBC->search($queryParamsBC);
		$dataProviderBC->sort = ['defaultOrder' => ['type' => SORT_ASC, 'start_date' => SORT_ASC], 'attributes' => ['type', 'start_date']];

        return $this->render('view-confirmation-letter', [
            'model' => $model,
            'searchModelBC' => $searchModelBC,
            'dataProviderBC' => $dataProviderBC,
        ]);
    }

    /**
     * Finds the OaTour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaTour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(($model = OaTour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    // returns true if $user is in comma separated list of ids $coagents
    private function isCoAgent($user, $coagents)
    {
	    return in_array($user, explode(',',$coagents));
    }
}