<?php

namespace backend\controllers;

use Yii;
use common\models\OaBookCost;
use common\models\OaBookCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OaBookCostController implements the CRUD actions for OaBookCost model.
 */
class OaBookCostController extends Controller
{
    public $canAdd = 0;
    public $canDel = 0;
    public $canMod = 1;

    public function beforeAction($action)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        if (isset($roles['OA-Accountant']) || isset($roles['OA-Admin'])) {
            $this->canAdd = 1;
            $this->canDel = 1;
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
     * Lists all OaBookCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaBookCostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort = ['defaultOrder' => ['due_date_for_pay' => SORT_ASC], 'attributes' => ['due_date_for_pay', 'pay_date']];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaBookCost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $model->need_to_pay = Yii::$app->params['yes_or_no'][$model->need_to_pay];

        $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->creator])->all(), 'id', 'username');
        if (array_key_exists($model->creator, $creator)) {
            $model->creator = $creator[$model->creator];
        }

        if ($model->type == OA_BOOK_COST_TYPE_GUIDE){
            $fid = ArrayHelper::map(\common\models\OaGuide::find()->where(['id' => $model->fid])->all(), 'id', 'name');
            if (array_key_exists($model->fid, $fid)) {
                $model->fid = $fid[$model->fid];
            }
        }
        elseif ($model->type == OA_BOOK_COST_TYPE_HOTEL) {
            $fid = ArrayHelper::map(\common\models\OaHotel::find()->where(['id' => $model->fid])->all(), 'id', 'name');
            if (array_key_exists($model->fid, $fid)) {
                $model->fid = $fid[$model->fid];
            }
        }
        elseif ($model->type == OA_BOOK_COST_TYPE_AGENCY) {
            $fid = ArrayHelper::map(\common\models\OaAgency::find()->where(['id' => $model->fid])->all(), 'id', 'name');
            if (array_key_exists($model->fid, $fid)) {
                $model->fid = $fid[$model->fid];
            }
        }
        elseif ($model->type == OA_BOOK_COST_TYPE_OTHER) {
            $fid = ArrayHelper::map(\common\models\OaOtherCost::find()->where(['id' => $model->fid])->all(), 'id', 'name');
            if (array_key_exists($model->fid, $fid)) {
                $model->fid = $fid[$model->fid];
            }
        }

        $model->type = Yii::$app->params['oa_book_cost_type'][$model->type];

        if (isset($model->pay_status)) {
            $model->pay_status = Yii::$app->params['yes_or_no'][$model->pay_status];
        }

        return $this->render('view', [
            'model' => $model,
            'tourClosed' =>  \common\models\Tools::tourClosed($model->tour_id)
        ]);
    }

    /**
     * Creates a new OaBookCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type=0, $tour_id='')
    {
        if(\common\models\Tools::tourClosed($tour_id)) {
            throw new ForbiddenHttpException('Tour closed. You are not allowed to perform this action.');
        }
        
        $model = new OaBookCost();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_time = date('Y-m-d H:i:s',time());
            $model->creator = Yii::$app->user->identity->id;
            $tour_id = $model->tour_id;
            if (($tourModel = \common\models\OaTour::findOne($tour_id)) !== null) {
                if ($model->type == OA_BOOK_COST_TYPE_GUIDE) {
                    if (($fModel = \common\models\OaGuide::findOne($model->fid)) !== null) {
                        $model->cl_info = $fModel->cl_english;
                    }
                }
                elseif ($model->type == OA_BOOK_COST_TYPE_HOTEL) {
                    if (($fModel = \common\models\OaHotel::findOne($model->fid)) !== null) {
                        $model->cl_info = $fModel->cl_english;
                    }
                }
                if ($model->save()) {
                    # code...
                }
            }
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $model->type = $type;
            if (!empty($tour_id)) {
                $model->tour_id = intval($tour_id);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaBookCost model.
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

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model['type'])) {
                unset($model['type']);
            }
            if ($model->save()) {
                # code...
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OaBookCost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
	    
        if(\common\models\Tools::tourClosed($model->tour_id))
        {
            throw new ForbiddenHttpException('Tour closed. You are not allowed to perform this action.');
        }
        else
        {
        	$model->delete();
        }

        return $this->redirect(['oa-tour/view', 'id' => $model->tour_id]);
    }

    /**
     * Finds the OaBookCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaBookCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaBookCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
