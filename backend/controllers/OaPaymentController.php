<?php

namespace backend\controllers;

use Yii;
use common\models\OaPayment;
use common\models\OaPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * OaPaymentController implements the CRUD actions for OaPayment model.
 */
class OaPaymentController extends Controller
{
    public $canAdd = 0;
    public $canDel = 0;
    public $canMod = 1;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        if(isset($roles['OA-Accountant']) || isset($roles['OA-Admin'])) {
            $this->canAdd = 1;
            $this->canDel = 1;
            $this->canMod = 1;
        }
        return parent::beforeAction($action);
    }

    public function render($templateName, $data=[])
    {
        $tmp['canAdd'] = $this->canAdd;
        $tmp['canDel'] = $this->canDel;
        $tmp['canMod'] = $this->canMod;
        $data['permission'] = $tmp;
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
     * Lists all OaPayment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaPaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 100];
		$dataProvider->sort = ['defaultOrder' => ['due_date' => SORT_ASC], 'attributes' => ['due_date', 'receit_date']];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaPayment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $oa_pay_method = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
        if(!empty($model->pay_method)):
            $model->pay_method = $oa_pay_method[$model->pay_method];
        else:
        	$model->pay_method = '-';
        endif;

        $oa_payer_type = \common\models\Tools::getEnvironmentVariable('oa_payer_type');
        if(!empty($model->payer_type)):
            $model->payer_type = $oa_payer_type[$model->payer_type];
        else:
        	$model->payer_type = '-';
        endif;
        
        $oa_receit_account = \common\models\Tools::getEnvironmentVariable('oa_receit_account');
        if(!empty($model->receit_account)) {
            $model->receit_account = $oa_receit_account[$model->receit_account];
        }

        return $this->render('view', [
            'model' => $model,
            'tourClosed' =>  \common\models\Tools::tourClosed($model->tour_id)
        ]);
    }

    /**
     * Creates a new OaPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tour_id='', $inquiry_id='')
    {
	    if($tour_id):
            $tourModel = \common\models\OaTour::findOne($tour_id);
	    	
	    	if($tourModel === null):
				throw new NotFoundHttpException("Tour does not exist.");
	    	endif;
	    
	    	if(\common\models\Tools::tourClosed($tour_id)) {
            	throw new ForbiddenHttpException('Tour closed. You are not allowed to perform this action.');
        	}
        endif;
        
	    if($inquiry_id):
	    	$inquiryModel = \common\models\OaInquiry::findOne($inquiry_id);
	    	
	    	if($inquiryModel === null):
				throw new NotFoundHttpException("Inquiry does not exist.");
	    	endif;
	    	
	    	if(\common\models\Tools::getEnvironmentVariable('oa_inquiry_status')[$inquiryModel->inquiry_status] != 'Waiting for Payment'):
				throw new ForbiddenHttpException("Inquiry status should be 'Waiting for Payment'.");
	    	endif;
        endif;
        
        $model = new OaPayment();

        if($model->load(Yii::$app->request->post())):
            $model->create_time = date('Y-m-d H:i:s',time());
            
            if($tour_id):
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			else:
        		$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			endif;
        else:
            if(!empty($tour_id)):
                $model->tour_id = $tour_id;
            elseif(!empty($inquiry_id)):
                $model->inquiry_id = $inquiry_id;
            else:
				throw new ForbiddenHttpException("Tour or Inquiry ID required.");
            endif;
            
            return $this->render('create', [
                'model' => $model,
            ]);
        endif;
    }

    /**
     * Updates an existing OaPayment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(\common\models\Tools::tourClosed($model->tour_id)) {
            throw new ForbiddenHttpException('Tour closed. You are not allowed to perform this action.');
        }

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaPayment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if($model !== null):
	        
        	$redirectId = $model->inquiry_id;
        	$redirectLink = 'inquiry';
        	
	        if(!empty($model->tour_id)):
	        	$redirectId = $model->tour_id;
	        	$redirectLink = 'tour';
	        
				if(\common\models\Tools::tourClosed($model->tour_id)):
					throw new ForbiddenHttpException('Tour closed. You are not allowed to perform this action.');
				endif;
	        endif;
	        
	        $model->delete();
        else:
			throw new NotFoundHttpException("Payment does not exist.");
        endif;

        return $this->redirect(['oa-' . $redirectLink . '/view', 'id' => $redirectId]);
    }

    /**
     * Finds the OaPayment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaPayment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if(($model = OaPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
