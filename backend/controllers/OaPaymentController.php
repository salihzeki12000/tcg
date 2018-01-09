<?php

namespace backend\controllers;

use Yii;
use common\models\OaPayment;
use common\models\OaPaymentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        if (isset($roles['OA-Accountant']) || isset($roles['OA-Admin'])) {
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
        if (!empty($model->pay_method)) {
            $model->pay_method = $oa_pay_method[$model->pay_method];
        }

        $oa_receit_account = \common\models\Tools::getEnvironmentVariable('oa_receit_account');
        if (!empty($model->receit_account)) {
            $model->receit_account = $oa_receit_account[$model->receit_account];
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OaPayment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tour_id)
    {
        $model = new OaPayment();

        if ($model->load(Yii::$app->request->post())) {
            $model->create_time = date('Y-m-d H:i:s',time());
            $tour_id = $model->tour_id;
            if (($tourModel = \common\models\OaTour::findOne($tour_id)) !== null) {
                if ($model->save()) {
                    # code...
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (!empty($tour_id)) {
                $model->tour_id = $tour_id;
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = OaPayment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
