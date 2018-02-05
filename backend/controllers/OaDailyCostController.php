<?php

namespace backend\controllers;

use Yii;
use common\models\OaDailyCost;
use common\models\OaDailyCostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * OaDailyCostController implements the CRUD actions for OaDailyCost model.
 */
class OaDailyCostController extends Controller
{
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
     * Lists all OaDailyCost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OaDailyCostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 100];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OaDailyCost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
	    
        $creator = ArrayHelper::map(\common\models\User::find()->where(['id' => $model->creator])->all(), 'id', 'username');
        if (array_key_exists($model->creator, $creator)) {
            $model->creator = $creator[$model->creator];
        }
        else{
            $model->creator = 'Webform';
        }

        $oa_pay_methods = \common\models\Tools::getEnvironmentVariable('oa_pay_method');
        if(!empty($model->pay_method)):
            $model->pay_method = $oa_pay_methods[$model->pay_method];
        else:
        	$model->pay_method = '-';
        endif;
	    
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new OaDailyCost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OaDailyCost();

        if ($model->load(Yii::$app->request->post())) {
            $model->creator = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OaDailyCost model.
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
     * Deletes an existing OaDailyCost model.
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
     * Finds the OaDailyCost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OaDailyCost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OaDailyCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSubcat() {
    	$out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $type = $parents[0];
                $out = \common\models\Tools::getDailyCostSubtypes($type);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}